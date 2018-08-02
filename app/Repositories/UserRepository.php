<?php
/**
 * Created by PhpStorm.
 * User: Hamza Alayed
 * Date: 17-10-29
 * Time: 3:10 PM
 */

namespace App\Repositories;


use App\Contracts\UserInterface;
use App\Entities\User;
use Illuminate\Container\Container as App;

/**
 * @property User $model
 * Class User
 * @package App\Repositories
 */
class UserRepository extends BaseRepository implements UserInterface
{
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->with = ['loans', 'payments'];
    }

    /**
     *
     * @return string
     */
    protected function getModelClass(): string
    {
        return User::class;
    }

    function create($attributes = [])
    {
        $attributes['password']= bcrypt($attributes['password']);
        return parent::create($attributes);
    }
}
