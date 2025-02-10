<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Illuminate\Mail\Events\MessageSending' => [
            \App\Listeners\ProcessSwiftMessage::class,
        ],

        'Illuminate\Mail\Events\MessageSent' => [
            \App\Listeners\RestartSwiftMailer::class,
        ],

        'Illuminate\Auth\Events\Registered' => [
            \App\Listeners\LogRegisteredUser::class,
        ],

        'Illuminate\Auth\Events\Login' => [
            \App\Listeners\RememberUserLocale::class,
            \App\Listeners\LogSuccessfulLogin::class,
            \App\Listeners\ActivateUser::class,
        ],

        'Illuminate\Auth\Events\Failed' => [
            \App\Listeners\LogFailedLogin::class,
        ],

        'Illuminate\Auth\Events\Logout' => [
            \App\Listeners\LogSuccessfulLogout::class,
        ],

        'Illuminate\Auth\Events\Lockout' => [
            \App\Listeners\LogLockout::class,
        ],

        'Illuminate\Auth\Events\PasswordReset' => [
            \App\Listeners\LogPasswordReset::class,
            \App\Listeners\SendPasswordChanged::class,
        ],

        \App\Events\UserDeleted::class => [
            \App\Listeners\LogUserDeletion::class,
        ],

        \App\Events\ConversationStatusChanged::class => [
            \App\Listeners\UpdateMailboxCounters::class,
        ],

        \App\Events\ConversationUserChanged::class => [
            \App\Listeners\UpdateMailboxCounters::class,
            \App\Listeners\SendNotificationToUsers::class,
        ],

        \App\Events\UserCreatedConversationDraft::class => [

        ],

        \App\Events\UserCreatedThreadDraft::class => [

        ],

        \App\Events\UserReplied::class => [
             \App\Listeners\SendReplyToCustomer::class,
             \App\Listeners\SendNotificationToUsers::class,
             \App\Listeners\RefreshConversations::class,
        ],

        \App\Events\CustomerReplied::class => [
            \App\Listeners\SendNotificationToUsers::class,
        ],

        \App\Events\UserCreatedConversation::class => [
            \App\Listeners\SendReplyToCustomer::class,
            \App\Listeners\SendNotificationToUsers::class,
            \App\Listeners\RefreshConversations::class,
        ],

        \App\Events\CustomerCreatedConversation::class => [
            \App\Listeners\SendAutoReply::class,
            \App\Listeners\SendNotificationToUsers::class,
        ],

        \App\Events\UserAddedNote::class => [
            \App\Listeners\SendNotificationToUsers::class,
            \App\Listeners\RefreshConversations::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
