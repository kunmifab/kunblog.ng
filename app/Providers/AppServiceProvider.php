<?php

namespace App\Providers;

use App\Models\Notification;
use App\Models\Post;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrapFour();
        view()->composer('*',function($view) {
            $posts = Post::with('category', 'author')->get();
            $paginatePosts = Post::with('category', 'author')->paginate(6);
            $popularPosts = Post::orderBy('views', 'desc')->get();
            $newNotifications = Notification::where('status','new')->get();
            $notifications = Notification::orderBy('created_at', 'desc')->get();
            $view->with('posts', $posts);
            $view->with('popularPosts', $popularPosts);
            $view->with('newNotifications', $newNotifications);
            $view->with('notifications', $notifications);
            $view->with('paginatePosts', $paginatePosts);
        });

    }
}
