<?php

App::uses('AppController', 'Controller');

class BlogsController extends AppController {

    var $layout = 'frontend/blog';
    var $uses = array('Article', 'Usermgmt.User');

    private function __readyDataForLayout() {
        $options = array(
            'conditions' => array('Article.user_id' => $this->request->params['bloger_id']),
            'order' => array('Article.created_at DESC'),
            'recursive' => -1
        );
        $articles = $this->Article->find('all', $options);

        $recent_articles = array_slice($articles, 0, 3);

        $dates_have_post = array();

        foreach ($articles as $article) {
            $date = new DateTime($article['Article']['created_at']);
            array_push($dates_have_post, $date->format('Y-m-d'));
        }
        $dates_have_post = array_unique($dates_have_post);
        $current_user_is_owner = false;
        $current_user = $this->Session->read('UserAuth');
        if (!empty($current_user) && ($current_user['User']['id'] == $this->request->params['bloger_id'])) {
            $current_user_is_owner = true;
        }

        $user = $this->User->read(null, $this->request->params['bloger_id']);
        $this->set('user', $user['User']);
        $this->set(compact('recent_articles', 'dates_have_post', 'articles', 'current_user_is_owner'));
    }

    public function index($bloger_id) {
        $this->__readyDataForLayout();
        $title_for_layout = "Blog giáo viên";
        $this->set(compact('title_for_layout'));
    }

    public function viewArticle($article_id) {
        $this->__readyDataForLayout();
        $article = $this->Article->read(null, $this->request->params['article_id']);
        $this->set(compact('article'));
    }

    public function writeArticle() {
        if ($this->request->is('get')) {
            $this->__readyDataForLayout();
        }
        if ($this->request->is('post')) {
            $user = $this->User->read(null, $this->request->data['Article']['user_id']);
            $this->Article->create();
            $blog_url = Router::url(array(
                        'controller' => 'blogs',
                        'action' => 'index',
                        'bloger_id' => $user['User']['id'],
                        'slug' => $this->Common->vnit_change_title($user['User']['first_name'])
            ));
            if ($this->Article->save($this->request->data)) {
                // $a  = $this->Article->save($this->request->data);
//                $this->Session->setFlash(__('Đăng bài viết thành công!'));
            } else {
                $this->Session->setFlash(__('Đã có lỗi xảy ra, tạo bài viết không thành công!'));
            }
            $this->redirect($blog_url);
        }
    }

    public function editArticle() {
        $this->__readyDataForLayout();


        if ($this->request->is(array('post', 'put'))) {
            $user = $this->User->read(null, $this->request->data['Article']['user_id']);
            if ($this->Article->save($this->request->data)) {
                $blog_url = Router::url(array(
                            'controller' => 'blogs',
                            'action' => 'index',
                            'bloger_id' => $user['User']['id'],
                            'slug' => $this->Common->vnit_change_title($user['User']['first_name'])
                ));
                $this->redirect($blog_url);
            } else {
                $this->Session->setFlash(__('Đã có lỗi xảy ra, cập nhật bài viết không thành công!'));
            }
        } else {
            $article = $this->Article->read(null, $this->request->params['article_id']);
            $this->request->data = $article;
            $this->set(compact('article'));
        }
    }

    public function deleteArticle() {
        $this->autoRender = false;
        $this->response->type('json');
        $response = array();
        $article = $this->Article->read(null, $this->request->data['article_id']);
        $current_user = $this->Session->read('UserAuth');
        if (!empty($current_user) && ($current_user['User']['id'] == $article['User']['id'])) {
            $this->Article->delete($this->request->data['article_id']);
        } else {
            
        }
        $this->response->body(json_encode($response));
    }

//Get articles with user_ud = $id
    public function view($id) {
        $options = array(
            'conditions' => array('Article.user_id' => $id)
        );
        $articles = $this->Article->find('all', $options);
        $this->set(compact('articles'));
    }

    /**
     * GET: /blog/filter_article_by_date
     * query: bloger_id, date
     */
    public function filterArticleByDate() {
        $current_user = $this->Session->read('UserAuth');
        $current_user_is_owner = false;
        if (!empty($current_user) && ($current_user['User']['id'] == $this->request->params['bloger_id'])) {
            $current_user_is_owner = true;
        }
        $this->autoRender = false;
        $this->response->type('json');
        $this->log($this->request->query, 'debug');
        $user_id = $this->request->query['bloger_id'];
        $date = $this->request->query['date'];

        $user = $this->User->read(null, $user_id);
        $this->set('user', $user['User']);

        $resp = array();

// This's a simple trick :)
        $from_date = $date . ' 00:00:00';
        $to_date = $date . ' 23:59:59';

        $this->log($from_date . ' -> ' . $to_date, 'debug');
        $options = array(
            'conditions' => array(
                'Article.user_id' => $user_id,
                'Article.created_at BETWEEN ' . "'$from_date'" . ' AND ' . "'$to_date'",
            ),
            'recursive' => -1
        );

        $articles = $this->Article->find('all', $options);
        $this->set(compact('articles', 'current_user_is_owner'));
// Get result list in html
        $view = new View($this, false);
        $html = $view->render('/Articles/articles_listing');
        $resp['html'] = $html;
        $this->response->body(json_encode($resp));
    }

}

?>
