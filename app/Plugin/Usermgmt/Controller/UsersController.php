<?php

/*
  This file is part of UserMgmt.

  Author: Chetan Varshney (http://ektasoftwares.com)

  UserMgmt is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  UserMgmt is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
 */

App::uses('UserMgmtAppController', 'Usermgmt.Controller');

class UsersController extends UserMgmtAppController {
	/**
	 * This controller uses following models
	 *
	 * @var array
	 */
	public $uses = array('Usermgmt.User', 'Usermgmt.UserGroup', 'Usermgmt.LoginToken');

	/**
	 * Called before the controller action.  You can use this method to configure and customize components
	 * or perform logic that needs to happen before each controller action.
	 *
	 * @return void
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->User->userAuth = $this->UserAuth;
	}

	/**
	 * Used to display all users by Admin
	 *
	 * @access public
	 * @return array
	 */
	public function index() {
		$this->User->unbindModel(array('hasMany' => array('LoginToken')));
		$this->paginate = array('order' => 'User.id desc');
		$users = $this->paginate();
		$this->set('users', $users);
		$this->set('title_for_layout', 'Danh sách người dùng');
	}

	/**
	 * Used to display detail of user by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return array
	 */
	public function viewUser($userId = null) {
		if (!empty($userId)) {
			$user = $this->User->read(null, $userId);
			$this->set('user', $user);
		} else {
			$this->redirect('/admin/nguoi-dung');
		}
	}

	/**
	 * Used to display detail of user by user
	 *
	 * @access public
	 * @return array
	 */
	public function myprofile() {
		$userId = $this->UserAuth->getUserId();
		$user = $this->User->read(null, $userId);
		$this->set('user', $user);
	}

	/**
	 * Used to logged in the site
	 *
	 * @access public
	 * @return void
	 */
	public function login() {
		$this->layout = 'admin/login';
		if ($this->request->isPost()) {
			//Check user permission to redirect, only admin goto /admin
			$redirect_url = "";
			if (isset($this->request->data['User']['continue_url'])) {
				$redirect_url = Router::url($this->request->data['User']['continue_url']);
			}


			$this->User->set($this->data);
			if ($this->User->LoginValidate()) {
				$username = $this->data['User']['username'];
				$password = $this->data['User']['password'];

				$user = $this->User->findByUsername($username);
				if (empty($user)) {
					$user = $this->User->findByEmail($username);
					if (empty($user)) {
						$this->Session->setFlash('Tên đăng nhập hoặc mật khẩu không đúng, vui lòng thử lại', 'flash_error');
						return;
					}
				}
				// check for inactive account
				if ($user['User']['id'] != 1 and $user['User']['active'] == 0) {
					$this->Session->setFlash('Tài khoản của bạn chưa được kích hoạt', 'flash_error');
					return;
				}
//                // check for verified account
//                if ($user['User']['id'] != 1 and $user['User']['email_verified'] == 0) {
//                    $this->Session->setFlash(__('Your registration has not been confirmed please verify your email or contact to Administrator'));
//                    return;
//                }
				if (empty($user['User']['salt'])) {
					$hashed = md5($password);
				} else {
					$hashed = $this->UserAuth->makePassword($password, $user['User']['salt']);
				}
				if ($user['User']['password'] === $hashed) {
					if (empty($user['User']['salt'])) {
						$salt = $this->UserAuth->makeSalt();
						$user['User']['salt'] = $salt;
						$user['User']['password'] = $this->UserAuth->makePassword($password, $salt);
						$this->User->save($user, false);
					}
					$this->UserAuth->login($user);
					$remember = (!empty($this->data['User']['remember']));
					if ($remember) {
						$this->UserAuth->persist('2 weeks');
					}
					$OriginAfterLogin = $this->Session->read('Usermgmt.OriginAfterLogin');
					$this->Session->delete('Usermgmt.OriginAfterLogin');
					if ($user['User']['user_group_id'] == 1) {
						$redirect_url = Router::url('/admin');
					} else {
						if (!isset($this->request->data['User']['continue_url'])) {
							$redirect_url = Router::url('/');
						}
					}
//                    $redirect = (!empty($OriginAfterLogin)) ? $OriginAfterLogin : $redirect_url;

					$this->redirect($redirect_url);
				} else {

					$this->Session->setFlash('Tên đăng nhập hoặc mật khẩu không đúng', 'flash_error');

					$this->redirect($redirect_url);
//                    return;
				}
			}
		}
	}

	/**
	 * Used to logged out from the site
	 *
	 * @access public
	 * @return void
	 */
	public function logout() {
		$this->UserAuth->logout();

		$this->log($this->request, 'debug');
		$redirect_url = '';
		if (isset($this->request->query['continue_url'])) {
			$redirect_url = $this->request->query['continue_url'];
		} else {
			$this->Session->setFlash('Bạn đã đăng xuất thành công.', 'flash_success');
			$redirect_url = LOGOUT_REDIRECT_URL;
		}
		$this->redirect($redirect_url);
	}

	/**
	 * Used to register on the site
	 *
	 * @access public
	 * @return void
	 */
	public function register() {
		$userId = $this->UserAuth->getUserId();
		if ($userId) {
			$this->redirect("/dashboard");
		}
		if (SITE_REGISTRATION) {
			$userGroups = $this->UserGroup->getGroupsForRegistration();
			$this->set('userGroups', $userGroups);
			if ($this->request->isPost()) {
				if (USE_RECAPTCHA && !$this->RequestHandler->isAjax()) {
					$this->request->data['User']['captcha'] = (isset($this->request->data['recaptcha_response_field'])) ? $this->request->data['recaptcha_response_field'] : "";
				}
				$this->User->set($this->data);
				if ($this->User->RegisterValidate()) {
					if (!isset($this->data['User']['user_group_id'])) {
						$this->request->data['User']['user_group_id'] = DEFAULT_GROUP_ID;
					} elseif (!$this->UserGroup->isAllowedForRegistration($this->data['User']['user_group_id'])) {
						$this->Session->setFlash(__('Please select correct register as'));
						return;
					}
					$this->request->data['User']['active'] = 1;
					if (!EMAIL_VERIFICATION) {
						$this->request->data['User']['email_verified'] = 1;
					}
					$ip = '';
					if (isset($_SERVER['REMOTE_ADDR'])) {
						$ip = $_SERVER['REMOTE_ADDR'];
					}
					$this->request->data['User']['ip_address'] = $ip;
					$salt = $this->UserAuth->makeSalt();
					$this->request->data['User']['salt'] = $salt;
					$this->request->data['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);
					$this->User->save($this->request->data, false);
					$userId = $this->User->getLastInsertID();
					$user = $this->User->findById($userId);
					if (SEND_REGISTRATION_MAIL && !EMAIL_VERIFICATION) {
						$this->User->sendRegistrationMail($user);
					}
					if (EMAIL_VERIFICATION) {
						$this->User->sendVerificationMail($user);
					}
					if (isset($this->request->data['User']['email_verified']) && $this->request->data['User']['email_verified']) {
						$this->UserAuth->login($user);
						$this->redirect('/');
					} else {
						$this->Session->setFlash(__('Please check your mail and confirm your registration'));
						$this->redirect('/register');
					}
				}
			}
		} else {
			$this->Session->setFlash(__('Sorry new registration is currently disabled, please try again later'));
			$this->redirect('/login');
		}
	}

	/**
	 * Used to change the password by user
	 *
	 * @access public
	 * @return void
	 */
	public function changePassword() {
		$userId = $this->UserAuth->getUserId();
		if ($this->request->isPost()) {
			$this->User->set($this->data);
			if ($this->User->RegisterValidate()) {
				$user = array();
				$user['User']['id'] = $userId;
				$salt = $this->UserAuth->makeSalt();
				$user['User']['salt'] = $salt;
				$user['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);
				$this->User->save($user, false);
				$this->LoginToken->deleteAll(array('LoginToken.user_id' => $userId), false);
				$this->Session->setFlash('Cập nhật mật khẩu thành công', 'flash_success');
				$this->redirect('/dashboard');
			}
		}
		$this->set('title_for_layout', 'Đổi mật khẩu');
	}

	/**
	 * Used to change the user password by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return void
	 */
	public function changeUserPassword($userId = null) {
		if (!empty($userId)) {
			$name = $this->User->getNameById($userId);
			$this->set('name', $name);
			if ($this->request->isPost()) {
				$this->User->set($this->data);
				if ($this->User->RegisterValidate()) {
					$user = array();
					$user['User']['id'] = $userId;
					$salt = $this->UserAuth->makeSalt();
					$user['User']['salt'] = $salt;
					$user['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);
					$this->User->save($user, false);
					$this->LoginToken->deleteAll(array('LoginToken.user_id' => $userId), false);
					$this->Session->setFlash('Đổi mật khẩu thành công cho ' . $name, 'flash_success');
					$this->redirect('/admin/nguoi-dung');
				}
			}
		} else {
			$this->redirect('/admin/nguoi-dung');
		}
	}

	/**
	 * Used to add user on the site by Admin
	 *
	 * @access public
	 * @return void
	 */
	public function addUser() {
		$modules = $this->User->modules;
		if ($this->request->isPost()) {
			//var_dump($this->request->data);
			//exit();
			$this->User->set($this->data);
			if ($this->User->RegisterValidate()) {
				$this->request->data['User']['email_verified'] = 1;
				$this->request->data['User']['active'] = 1;
				$this->request->data['User']['user_group_id'] = DEFAULT_GROUP_ID;
				$salt = $this->UserAuth->makeSalt();
				$this->request->data['User']['salt'] = $salt;
				$this->request->data['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);
				$this->User->bindModel(array('hasAndBelongsToMany' => array(
						'Category' => array(
							'joinTable' => 'user_categories',
							'foreignKey' => 'user_id',
							'associationForeignKey' => 'category_id',
						),
				)));
				$user = $this->User->save($this->request->data, false);
				$this->loadModel('UserModule');
				$moduleData = array();
				foreach ($this->request->data['Module'] as $k) {
					$moduleData['user_id'] = $user['User']['id'];
					$moduleData['module_id'] = $k;
					$this->UserModule->create();
					$this->UserModule->save($moduleData, false);
				}
				$this->Session->setFlash('Lưu thành công người dùng', 'flash_success');
				$this->redirect('/admin/nguoi-dung');
			}
		}
		$this->loadModel('Category');
		//$this->Category->recursive = 1;
		$this->Category->unbindModel(array('hasMany' => array('Post')));
		$categories = $this->Category->find('threaded', array('fields' => array('id', 'parent_id', 'name', 'alias')));
		//debug($categories); exit();
		$this->set('categories', $categories);
		$this->set('modules', $modules);
		$this->set('title_for_layout', 'Thêm người dùng');
	}

	/**
	 * Used to edit user on the site by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return void
	 */
	public function editUser($userId = null) {
		$modules = $this->User->modules;
		$this->loadModel('UserCategory');
		$this->loadModel('UserModule');
		if (!empty($userId)) {
			$userGroups = $this->UserGroup->getGroups();
			$this->set('userGroups', $userGroups);
			if ($this->request->isPost()) {
				//var_dump($this->request->data); exit();
				$this->User->set($this->data);
				if ($this->User->RegisterValidate()) {
					$this->User->bindModel(array('hasAndBelongsToMany' => array(
							'Category' => array(
								'joinTable' => 'user_categories',
								'foreignKey' => 'user_id',
								'associationForeignKey' => 'category_id',
							),
					)));

					$this->UserCategory->deleteAll(array('UserCategory.user_id' => $userId));
					$this->UserModule->deleteAll(array('UserModule.user_id' => $userId));
					$this->request->data['User']['id'] = $userId;
					$this->User->save($this->request->data, false);
					$data = array();
					foreach ($this->request->data['Category'] as $k) {
						$data['UserCategory']['user_id'] = $userId;
						$data['UserCategory']['category_id'] = $k;
						$this->UserCategory->create();
						$this->UserCategory->save($data);
					}
					if(!empty($this->request->data['Module'])) {
						$moduleData = array();
						foreach ($this->request->data['Module'] as $k) {
							$moduleData['user_id'] = $userId;
							$moduleData['module_id'] = $k;
							$this->UserModule->create();
							$this->UserModule->save($moduleData, false);
						}
					}
					$this->Session->setFlash('Sửa thành công', 'flash_success');
					$this->redirect('/admin/nguoi-dung');
				}
			} else {
				$user = $this->User->read(null, $userId);
				$this->request->data = null;
				if (!empty($user)) {
					$user['User']['password'] = '';
					$this->request->data = $user;
				}
			}
		} else {
			$this->redirect('/admin/nguoi-dung');
		}
		$this->loadModel('Category');
		$this->Category->recursive = 1;
		$this->Category->unbindModel(array('hasMany' => array('Post')));
		$categories = $this->Category->find('threaded', array('fields' => array('id', 'parent_id', 'name', 'alias')));

		$categoriesTmp = $this->UserCategory->find('all', array('fields' => array('UserCategory.category_id'), 'conditions' => array('UserCategory.user_id' => $userId)));
		$categoriesAllow = array();
		foreach ($categoriesTmp as $k) {
			array_push($categoriesAllow, $k['UserCategory']['category_id']);
		}

		$modulesAllow = array();
		$modulesTmp = $this->UserModule->find('all', array('fields' => array('UserModule.module_id'), 'conditions' => array('UserModule.user_id' => $userId)));
		foreach ($modulesTmp as $k) {
			array_push($modulesAllow, $k['UserModule']['module_id']);
		}
		$this->set('modulesAllow', $modulesAllow);
		$this->set('categoriesAllow', $categoriesAllow);
		$this->set('categories', $categories);
		$this->set('modules', $modules);
		$this->set('title_for_layout', 'Cập nhật thông tin tài khoản');
	}

	/**
	 * Used to delete the user by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return void
	 */
	public function deleteUser($userId = null) {
		if (!empty($userId)) {
			if ($this->request->isPost()) {
				if ($this->User->delete($userId, false)) {
					$this->loadModel('UserCategory');
					$this->UserCategory->deleteAll(array('UserCategory.user_id' => $userId));
					$this->LoginToken->deleteAll(array('LoginToken.user_id' => $userId), false);
					$this->Session->setFlash('Xóa người dùng thành công', 'flash_success');
				}
			}
			$this->redirect('/admin/nguoi-dung');
		} else {
			$this->redirect('/admin/nguoi-dung');
		}
	}

	/**
	 * Used to show dashboard of the user
	 *
	 * @access public
	 * @return array
	 */
	public function dashboard() {
		$userId = $this->UserAuth->getUserId();
		$user = $this->User->findById($userId);
		$this->set('user', $user);
	}

	/**
	 * Used to activate or deactivate user by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @param integer $active active or inactive
	 * @return void
	 */
	public function makeActiveInactive($userId = null, $active = 0) {
		if (!empty($userId)) {
			$user = array();
			$user['User']['id'] = $userId;
			$user['User']['active'] = ($active) ? 1 : 0;
			$this->User->save($user, false);
			if ($active) {
				$this->Session->setFlash(__('User is successfully activated'));
			} else {
				$this->Session->setFlash(__('User is successfully deactivated'));
			}
		}
		$this->redirect('/admin/nguoi-dung');
	}

	/**
	 * Used to verify email of user by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return void
	 */
	public function verifyEmail($userId = null) {
		if (!empty($userId)) {
			$user = array();
			$user['User']['id'] = $userId;
			$user['User']['email_verified'] = 1;
			$this->User->save($user, false);
			$this->Session->setFlash(__('Đã kích hoạt tài khoản thành công.'), 'flash_success');
		}
		$this->redirect('/admin/nguoi-dung');
	}

	/**
	 * Used to show access denied page if user want to view the page without permission
	 *
	 * @access public
	 * @return void
	 */
	public function accessDenied() {
		
	}

	/**
	 * Used to verify user's email address
	 *
	 * @access public
	 * @return void
	 */
	public function userVerification() {
		if (isset($_GET['ident']) && isset($_GET['activate'])) {
			$userId = $_GET['ident'];
			$activateKey = $_GET['activate'];
			$user = $this->User->read(null, $userId);
			if (!empty($user)) {
				if (!$user['User']['email_verified']) {
					$password = $user['User']['password'];
					$theKey = $this->User->getActivationKey($password);
					if ($activateKey == $theKey) {
						$user['User']['email_verified'] = 1;
						$this->User->save($user, false);
						if (SEND_REGISTRATION_MAIL && EMAIL_VERIFICATION) {
							$this->User->sendRegistrationMail($user);
						}
						$this->Session->setFlash(__('Thank you, your account is activated now'));
					}
				} else {
					$this->Session->setFlash(__('Thank you, your account is already activated'));
				}
			} else {
				$this->Session->setFlash(__('Sorry something went wrong, please click on the link again'));
			}
		} else {
			$this->Session->setFlash(__('Sorry something went wrong, please click on the link again'));
		}
		$this->redirect('/login');
	}

	/**
	 * Used to send forgot password email to user
	 *
	 * @access public
	 * @return void
	 */
	public function forgotPassword() {
		if ($this->request->isPost()) {
			$this->User->set($this->data);
			if ($this->User->LoginValidate()) {
				$email = $this->data['User']['email'];
				$user = $this->User->findByUsername($email);
				if (empty($user)) {
					$user = $this->User->findByEmail($email);
					if (empty($user)) {
						$this->Session->setFlash(__('Incorrect Email/Username'));
						return;
					}
				}
				// check for inactive account
				if ($user['User']['id'] != 1 and $user['User']['email_verified'] == 0) {
					$this->Session->setFlash(__('Your registration has not been confirmed yet please verify your email before reset password'));
					return;
				}
				$this->User->forgotPassword($user);
				$this->Session->setFlash(__('Please check your mail for reset your password'));
				$this->redirect('/login');
			}
		}
	}

	/**
	 *  Used to reset password when user comes on the by clicking the password reset link from their email.
	 *
	 * @access public
	 * @return void
	 */
	public function activatePassword() {
		if ($this->request->isPost()) {
			if (!empty($this->data['User']['ident']) && !empty($this->data['User']['activate'])) {
				$this->set('ident', $this->data['User']['ident']);
				$this->set('activate', $this->data['User']['activate']);
				$this->User->set($this->data);
				if ($this->User->RegisterValidate()) {
					$userId = $this->data['User']['ident'];
					$activateKey = $this->data['User']['activate'];
					$user = $this->User->read(null, $userId);
					if (!empty($user)) {
						$password = $user['User']['password'];
						$thekey = $this->User->getActivationKey($password);
						if ($thekey == $activateKey) {
							$user['User']['password'] = $this->data['User']['password'];
							$salt = $this->UserAuth->makeSalt();
							$user['User']['salt'] = $salt;
							$user['User']['password'] = $this->UserAuth->makePassword($user['User']['password'], $salt);
							$this->User->save($user, false);
							$this->Session->setFlash(__('Your password has been reset successfully'));
							$this->redirect('/login');
						} else {
							$this->Session->setFlash(__('Something went wrong, please send password reset link again'));
						}
					} else {
						$this->Session->setFlash(__('Something went wrong, please click again on the link in email'));
					}
				}
			} else {
				$this->Session->setFlash(__('Something went wrong, please click again on the link in email'));
			}
		} else {
			if (isset($_GET['ident']) && isset($_GET['activate'])) {
				$this->set('ident', $_GET['ident']);
				$this->set('activate', $_GET['activate']);
			}
		}
	}

	/**
	 * Used to send email verification mail to user
	 *
	 * @access public
	 * @return void
	 */
	public function emailVerification() {
		if ($this->request->isPost()) {
			$this->User->set($this->data);
			if ($this->User->LoginValidate()) {
				$email = $this->data['User']['email'];
				$user = $this->User->findByUsername($email);
				if (empty($user)) {
					$user = $this->User->findByEmail($email);
					if (empty($user)) {
						$this->Session->setFlash(__('Incorrect Email/Username'));
						return;
					}
				}
				if ($user['User']['email_verified'] == 0) {
					$this->User->sendVerificationMail($user);
					$this->Session->setFlash(__('Please check your mail to verify your email'));
				} else {
					$this->Session->setFlash(__('Your email is already verified'));
				}
				$this->redirect('/login');
			}
		}
	}

}
