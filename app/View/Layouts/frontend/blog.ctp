<!DOCTYPE html>
<html lang="en">
    <head>
        <meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
		<link rel="shortcut icon" href="<?php echo $this->Html->webroot('img/favicon.ico') ?>" type="image/x-icon">
		<link rel="icon" href="<?php echo $this->Html->webroot('img/favicon.ico') ?>" type="image/x-icon">
        <title>Blog giáo viên</title>
		<?php echo $this->Html->css(array('blog/aristo', 'vendor/bootstrap-2.3.2', 'blog/blog')) ?>
		<?php
		echo $this->Html->script(array(
			'vendor/jquery-1.10.2.min', 'blog/jquery-ui-1.9.2.custom.min'))

		?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class='custom-font-enabled'>
        <div class='site' id='page'>
            <header class='site-header' id='masthead'>
                <div class='header section' id='header'><div class='widget Header' id='Header1'>
                        <div id='header-inner' >
                            <div class='titlewrapper' style="float:left">
                                <h1 class='site-title'>
                                    <a href='/'>Blog giáo viên</a>
                                </h1>
                                <h2 class='site-description'>Học, học nữa, học mãi</h2>
                            </div>

                            <span class="login-blog-form" style="float:right"> 
								<?php $current_user = $this->Session->read('UserAuth'); ?>
								<?php $user_slug = $this->Common->vnit_change_string(Inflector::slug($user['username'])) ?>
								<?php
								$blog_url = Router::url(
												array(
													'controller' => 'blogs',
													'action' => 'index',
													'bloger_id' => $user['id'],
													'slug' => $user_slug
												)
										)

								?>
								<?php if (!empty($current_user)): ?>
									<p>Chào mừng <a><?php echo $current_user['User']['first_name'] . ' ' . $current_user['User']['last_name'] ?></a> , 
										<a href="<?php echo Router::url('/logout?' . 'continue_url=' . $blog_url) ?>">Đăng xuất</a>
									</p>
									<?php if ($current_user_is_owner): ?>
										<?php
										echo $this->Html->link('Đăng bài', array(
											'controller' => 'blogs',
											'action' => 'writeArticle',
											'bloger_id' => $user['id'],
											'slug' => $user_slug
												), array('class' => 'btn btn-small')
										)

										?>
									<?php endif; ?>

<?php else: ?>
										<?php echo $this->Form->create('User', array('url' => '/login', 'class' => 'form-signin')); ?>
										<?php echo $this->Form->hidden('continue_url', array('value' => $blog_url)) ?>
									<?php echo $this->Form->input('username', array('placeholder' => 'Tên đăng nhập', 'label' => false, 'div' => false)) ?>
									<?php echo $this->Form->input('password', array('type' => 'password', 'placeholder' => 'Mật khẩu', 'label' => false, 'div' => false)) ?>
									<button class="btn btn-small" type="submit">Đăng nhập</button>
									<span style="color: rgb(185, 74, 72);">
	<?php echo $this->Session->flash(); ?>
									</span>
<?php endif; ?>

                            </span>
                        </div>
                    </div>
                </div>
                <div style="clear:both"> </div>
                <div class='main-navigation' id='site-navigation' role='navigation'>
                    <div class='nav-menu'>
                        <div class='nbttopmenu section' id='nbttopmenu'><div class='widget PageList' id='PageList8'>
                                <div class='widget-content'>
                                    <ul>
                                        <li id='currentpage'>
											<?php $user_slug = $this->Common->vnit_change_string(Inflector::slug($user['username'])) ?>
											<?php
											echo $this->Html->link("Trang chủ", array(
												'controller' => 'blogs',
												'action' => 'index',
												'bloger_id' => $user['id'],
												'slug' => $user_slug)
											)

											?>
                                        </li>
                                        <li><a href='#'>Tài liệu</a></li>
                                        <li><a href='#'>Giới thiệu</a></li>
                                        <li id="search-bar"> <aside class='widget widget_search' id='search-3'>
                                                <form action='' id='searchform' method='get'>
                                                    <div>
                                                        <input id='s' name='q' type='text' class="input-medium" value=''/>
                                                        <button id='search_submit_btn' type='submit' class="btn">Tìm</button>
                                                    </div>
                                                </form>
                                            </aside>
                                        </li>

                                    </ul>
                                    <div class='clear'></div>

                                    <div class='clear'></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </header>
            <div class='wrapper'>
                <div class='site-content'>
<?php echo $this->Session->flash(); ?>
                    <div id='blog-content'>
<?php echo $this->fetch('content') ?>
                    </div>
                </div>
                <div class='sidebar'>
                    <div class='sidebar-children'>
                        <div class='widget-content'>
                            <div id="user-infor" style="">    
                                <h2>Giới thiệu </h2>
                                <div>
                                    <ul>
                                        <li>Họ tên: <?php echo $user['first_name'] . ' ' . $user['last_name'] ?></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class='clear'></div>
                    </div>
                    <div class='sidebar-children'>
                        <div class='widget-content'>
                            <div id="blog-calendar">

                            </div>
                        </div>
                        <div class='clear'></div>
                    </div>

                    <div class='sidebar-children'>
                        <h2>Bài viết mới nhất</h2>
                        <div class='popular-posts'>
                            <ul>
<?php foreach ($recent_articles as $art) : ?>
									<li>
										<a href="#"><?php echo $art['Article']['title'] ?></a>
									</li>
<?php endforeach; ?>
                            </ul>

                            <div class='clear'></div>
                        </div>
                    </div>

                </div>
            </div><!-- #secondary -->
        </div><!-- #main .wrapper -->
        <footer>
            <div class='site-info'>
                <!-- you have not permission to remove this footer credits -->
                Copyright 2013 
            </div>
        </footer>
        <script type='text/javascript'>
			$(document).ready(function() {
				var dates_have_post = <?php echo json_encode($dates_have_post) ?>;
				function filterArticleSender(date) {
					$.ajax({
						url: '/blog/filter_article_by_date',
						type: 'GET',
						data: {bloger_id: '<?php echo $user['id'] ?>', date: date},
						success: function(response) {
							var articles_list_container = $('#blog-content');
							articles_list_container.fadeOut(300, function() {
								articles_list_container.html(response['html']).fadeIn(300);
							});
						},
						error: function() {
							alert('Có lỗi xảy ra. Thao tác không thành công.');
						}
					});
				}
				function filterArticleByDate(dateSelected) {
					for (i = 0; i < dates_have_post.length; i++) {
						if (dateSelected === dates_have_post[i]) {
							filterArticleSender(dateSelected);
						}
					}
				}

				$('#blog-calendar').datepicker({
					monthNames: ['Tháng 1 / ', 'Tháng 2 / ', 'Tháng 3 / ', 'Tháng 4 / ', 'Tháng 5 / ', 'Tháng 6 / ',
						'Tháng 7 / ', 'Tháng 8 / ', 'Tháng 9 / ', 'Tháng 10 / ', 'Tháng 11 / ', 'Tháng 12 / '],
					dateFormat: 'yy-mm-dd',
					beforeShowDay: function(date) {
						var dateInStr = date.getFullYear() + '-';
						var month = date.getMonth() + 1;
						dateInStr += (month < 10 ? ('0' + month) : ('' + month)) + '-';
						var day = date.getDate();
						dateInStr += (day < 10 ? ('0' + day) : ('' + day));
						for (i = 0; i < dates_have_post.length; i++) {
							if (dateInStr === dates_have_post[i]) {
								return [true, 'date-have-post'];
							}
						}
						return [true];
					},
					onSelect: filterArticleByDate,
					dayNamesMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"]
				});
			});

        </script>
    </body>
</html>