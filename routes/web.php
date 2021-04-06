<?php




// google
Route::get('/login/google/redirect', 'SocialController@googleredirect');
Route::get('/login/google/callback', 'SocialController@googlecallback');
// Home
Route::prefix( '/' )->group( function ()
{
    // Visitor pages
    Route::get( '/', 'SalfnyController@index' )->name('index');
    Route::get( '/contact_us', 'SalfnyController@contactus' )->name('contact_us');
    Route::post( '/contact_us/message', 'SalfnyController@sendmessage')->name('send_message');
    Route::get( '/questions', 'SalfnyController@questions' )->name('questions');
    Route::post( '/question/sendquestion', 'SalfnyController@sendquestion' )->name('send_question');
    Route::get( '/reviews', 'SalfnyController@review' )->name('reviews');
    Route::get( '/about_us', 'SalfnyController@aboutus' )->name('about_us');
    // After Login

    Route::get( '/offers/offerssearch', 'OfferController@offerssearch')->name('offerssearch');
    Route::prefix( '/me' )->middleware('auth')->group( function ()
    {
        // Normal
        Route::get( '/', 'AfterloginController@index')->name('me');
        Route::get( '/myprofile', 'AfterloginController@myprofile')->name('profile');
        Route::get( '/userprofile/{user}', 'AfterloginController@userprofile')->name('userprofile');
        Route::put( '/updateprofile', 'AfterloginController@updateprofile')->name('updateprofile');
        Route::post( '/sendreview', 'AfterloginController@storereview')->name('sendreview');
        // posts & comments
        Route::prefix( 'posts' )->group( function ()
        {
            // posts
            Route::post('/storepost', 'PostController@store')->name('storepost');
            Route::get('/show/{post}', 'PostController@show')->name('showpost');
            Route::get('/editpost/{post}', 'PostController@edit')->name('editpost');
            Route::put('/updatepost/{post}', 'PostController@update')->name('updatepost');
            Route::get('/deleteopost/{post}', 'PostController@delete')->name('deleteopost');
            // comments
            Route::post('/storecomment/{post}', 'PostController@storecomment')->name('storecomment');
            Route::get('/destroycomment/{comment}', 'PostController@destroycomment')->name('deletecomment');
            // likes
            Route::get('storelike/{post}', 'PostController@storelike')->name('storelike');
        });
        // offers
        Route::prefix( 'offers' )->group( function ()
        {
            Route::get( '/', 'OfferController@index')->name('offers');
            Route::get( '/show/{slug}', 'OfferController@show')->name('showoffer');
            Route::get( '/new', 'OfferController@new')->name('newoffer');
            Route::post( '/store', 'OfferController@store')->name('storeoffer');
            Route::get( '/edit/{offer}', 'OfferController@edit' )->name('editoffer');
            Route::put( '/update/{offer}', 'OfferController@update')->name('updateoffer');
            Route::get( '/delete/{offer}', 'OfferController@delete')->name('deleteoffer');
        });
        // users
        Route::prefix( 'users' )->group( function ()
        {
            Route::get('/', 'UserController@index')->name('users');
        });
        // notifications
        Route::prefix( '/notifications' )->middleware('auth')->group( function ()
        {
            Route::get('/', 'NotificationController@index')->name('notifications');
            Route::get('/readallnotfs', 'NotificationController@readallnotfs')->name('readallnotfs');
            Route::get('/deleteallnotfs', 'NotificationController@deleteallnotfs')->name('deleteallnotfs');
            Route::get('/{notf}', 'NotificationController@asread')->name('asreadnotf');
            Route::get('/delete/{notf}', 'NotificationController@deletenotf')->name('deletenotf');
        });
        // notices
        Route::prefix( 'notices' )->group( function ()
        {
            Route::post('/postnotice/{post}', 'NoticeController@postnotice')->name('postnotice');
            Route::post('/commentnotice/{comment}', 'NoticeController@commentnotice')->name('commentnotice');
            Route::post('/usernotice/{user}', 'NoticeController@usernotice')->name('usernotice');
            Route::post('/offernotice/{offer}', 'NoticeController@offernotice')->name('offernotice');
        });
        // needs
        Route::prefix( 'needs' )->group( function ()
        {
            Route::get('/takeoffer/{offer}', 'NeedController@takeoffer')->name('takeoffer');
            Route::get('/removeneed/{need}', 'NeedController@removeneed')->name('removeneed');
        });
        //chat
        Route::prefix( 'chat' )->group( function ()
        {
            Route::get( '/', 'ChatController@index')->name('chat');
            Route::get('/searchingusers', 'ChatController@searchingusers')->name('chat_searching');
            Route::get( '/show/{user}', 'ChatController@show')->name('showchat');
            Route::get('/chatdata/{user}','ChatController@chatdata')->name('chatdata');
            Route::post( '/storechat/{user}', 'ChatController@storechat')->name('storechat');
            Route::get('/searchingusers', 'ChatController@searchingusers')->name('chat_searching');

            Route::put( '/{user}/destroychat', 'ChatController@destroychat' );
            Route::get( '/{notfchat}/asreadchat', 'ChatController@asreadchat' );


        });
    });









    /********************************************** */
    // admin
	Route::group(['middleware'=>['web','admin']],function ()
    {
        Route::prefix('/salfnyadmin')->middleware('auth')->group(function ()
        {
            Route::get('/', 'AdminController@index');
            // users
            Route::get('/users', 'AdminController@users');
            Route::get('/{user}/profile', 'AdminController@profile');
            Route::delete('/{user}/destroyuser', 'AdminController@destroyuser');
            // offers
            Route::get('/offers', 'AdminController@offers');
            Route::delete('/{offer}/destroyoffer', 'AdminController@destroyoffer');
            // categories
            Route::get('/categories', 'AdminController@categories');
            Route::post('/categories/storecategory', 'AdminController@storecategory');
            Route::get('/{category}/editcategory', 'AdminController@editcategory');
            Route::put('/{category}/updatecategory', 'AdminController@updatecategory');
            Route::delete('/{category}/destroycategory', 'AdminController@destroycategory');
            // posts
            Route::get('/posts', 'AdminController@posts');
            Route::delete('/{post}/destroypost', 'AdminController@destroypost');
            // comments
            Route::delete('/{comment}/destroycomment', 'AdminController@destroycomment');
            // contacts
            Route::get('/contacts', 'AdminController@contacts');
            Route::delete('/{contact}/destroycontact', 'AdminController@destroycontact');
            // reviews
            Route::get('/reviews', 'AdminController@reviews');
            Route::delete('/{review}/destroyreview', 'AdminController@destroyreview');
            // Question
            Route::get('/questions', 'AdminController@questions');
            Route::get('/{question}/editquestion', 'AdminController@editquestion');
            Route::put('/{question}/updatequestion', 'AdminController@updatequestion');
            Route::get('/{question}/publishquestion', 'AdminController@publishquestion');
            Route::get('/{question}/hidequestion', 'AdminController@hidequestion');
            Route::delete('/{question}/destroyquestion', 'AdminController@destroyquestion');
            // notifications
            Route::get('/{notf}/asread', 'AdminController@asread');
            Route::get('/allasread', 'AdminController@allasread');
            // chat
            Route::get('/chats', 'AdminController@chats');
            Route::get('/{user}/showchat', 'AdminController@showchat');
            Route::post('/{user}/storechat', 'AdminController@storechat');
            Route::delete('/{user}/destroychat', 'AdminController@destroychat');
            Route::get('/{notfchat}/asreadchat', 'AdminController@asreadchat');
            // setting
            Route::get('/setting', 'AdminController@setting');
            Route::put('/{site}/updatesettingslides', 'AdminController@updatesettingslides');
            Route::put('/{site}/updatesettingsocial', 'AdminController@updatesettingsocial');
            Route::put('/{site}/updatesettinginformation', 'AdminController@updatesettinginformation');

        });
    });
    /*****/

});


/************************************************/
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
