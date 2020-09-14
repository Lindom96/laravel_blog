<?php
Route::group(['prefix' => 'admin'], function () {
    //登录
    Route::post('/login', 'Admin\LoginController@login');
    //取得除管理员外所有作者
    Route::get('/authors/other', 'Admin\AuthorController@getAuthors');
    //取得某个作者信息
    Route::get('/author/info', 'Admin\AuthorController@getAuthors');
    //取得除管理员外所有作者 
    Route::get('/authors', 'Admin\AuthorController@getAuthors');
    //添加作者
    Route::post('/author', 'Admin\AuthorController@addAuthor');
    //编辑作者
    Route::put('/author/info', 'Admin\AuthorController@setAuthor');
    //编辑作者头像
    Route::put('/author/avatar', 'Admin\AuthorController@setAvatar');
    //删除作者
    Route::delete('/author', 'Admin\AuthorController@deleteAuthor');
    //修改密码
    Route::put('/author/password', 'Admin\AuthorController@updatePassword');
});


//添加文档
Route::post('/file', 'File\FileController@addFiles');
//编辑作者头像
Route::put('/file', 'File\FileController@addFiles');

//取得所有文章
Route::get('/articles', 'Article\ArticleController@getArticles');
//取得所有文章
Route::post('/article', 'Article\ArticleController@addArticle');
//取得所有文章内容
Route::get('/article/content', 'Article\ArticleController@getContent');
//修改文章
Route::put('/article', 'Article\ArticleController@updateArticle');
//修改精选
Route::put('/article/star', 'Article\ArticleController@setStar');
//修改公开
Route::put('/article/public', 'Article\ArticleController@setPublic');
//修改状态
Route::put('/article/status', 'Article\ArticleController@setStatus');
//删除文章
Route::delete('/article', 'Article\ArticleController@delArticle');

//取得所有分类
Route::get('/cats', 'Cat\CatController@getCats');
//新增分类
Route::post('/cat', 'Cat\CatController@addCat');
//修改分类
Route::put('/cat', 'Cat\CatController@setCat');
//删除分类
Route::delete('/cat', 'Cat\CatController@delCat');


//取得所有标签
Route::get('/tags', 'Tag\TagController@getTags');
//新增标签
Route::post('/tag', 'Tag\TagController@addTag');
//修改标签
Route::put('/tag', 'Tag\TagController@setTag');
//删除标签
Route::delete('/tag', 'Tag\TagController@delTag');

//取得所有评论
Route::get('/messages', 'Comment\CommentController@getComments');


//取得所有友链
Route::get('/blog/friends', 'Blog\BlogController@getFriends');
//新增友链
Route::post('/blog/friend', 'Blog\BlogController@addFriend');
//更新友链
Route::put('/blog/friend', 'Blog\BlogController@setFriend');
//删除友链
Route::delete('/blog/friend', 'Blog\BlogController@delFriend');
