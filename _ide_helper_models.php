<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\OAuthProvider
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider
 * @property string $provider_user_id
 * @property string|null $access_token
 * @property string|null $refresh_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider query()
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider whereProviderUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider whereRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OAuthProvider whereUserId($value)
 */
	class OAuthProvider extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Section
 *
 * @property int $id
 * @property int|null $parent_id
 * @property bool $is_active
 * @property string $title
 * @property string|null $description
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Section> $children
 * @property-read int|null $children_count
 * @property-read array $breadcrumb
 * @property-read Section|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read int|null $tasks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Section> $tree
 * @property-read int|null $tree_count
 * @method static \Illuminate\Database\Eloquent\Builder|Section active()
 * @method static \Illuminate\Database\Eloquent\Builder|Section newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section query()
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereUpdatedAt($value)
 */
	class Section extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Task
 *
 * @property int $id
 * @property int $section_id
 * @property int $task_handler_id
 * @property bool $is_active
 * @property string $title
 * @property string|null $description
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $breadcrumb
 * @property-read \App\Models\Section $section
 * @property-read \App\Models\TaskHandler $taskHandler
 * @method static \Illuminate\Database\Eloquent\Builder|Task active()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereTaskHandlerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedAt($value)
 */
	class Task extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TaskHandler
 *
 * @property int $id
 * @property string $name
 * @property string $handler
 * @property string $formula
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read int|null $tasks_count
 * @method static \Illuminate\Database\Eloquent\Builder|TaskHandler newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskHandler newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskHandler query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskHandler whereFormula($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskHandler whereHandler($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskHandler whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskHandler whereName($value)
 */
	class TaskHandler extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property bool $is_active
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OAuthProvider> $oauthProviders
 * @property-read int|null $oauth_providers_count
 * @method static \Illuminate\Database\Eloquent\Builder|User active()
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject {}
}

