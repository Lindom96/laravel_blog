<?php
Route::group(['prefix' => 'admin'], function () {
    //登录
    Route::post('/login', 'Admin\LoginController@login');
    //取得除管理员外所有作者
    Route::get('/authors/other', 'Admin\AuthorController@getAuthors');
    //取得除管理员外所有作者 
    Route::get('/authors', 'Admin\AuthorController@getAuthors');
    //添加作者
    Route::post('/authors', 'Admin\AuthorController@addAuthor');
    //编辑作者
    Route::put('/author/info', 'Admin\AuthorController@setAuthor');
    //删除作者
    Route::delete('/author', 'Admin\AuthorController@deleteAuthor');
    //修改密码
    Route::put('/author/password', 'Admin\AuthorController@updatePassword');
});


//添加文档
Route::post('/file', 'File\FileController@addFiles');
//取得所有文章
Route::get('/articles', 'Article\ArticleController@getArticles');
//取得所有文章
Route::get('/article/content', 'Article\ArticleController@getContent');

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
Route::get('/comments', 'Comment\CommentController@getComments');
