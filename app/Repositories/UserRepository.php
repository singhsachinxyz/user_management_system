<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserRepository    //DAO Layer
{
    protected $cacheKey = 'users';

    public function getAll()
    {
        return Cache::remember($this->cacheKey, now()->addHour(), function () {
            return User::get();
        });
    }

    public function get($id)
    {
        $cacheKey = "{$this->cacheKey}.{$id}";
        return Cache::remember($cacheKey, now()->addHour(), function () use ($id) {
            return User::find($id);
        });
    }

    public function create($data)
    {
        $user = User::create($data);
        $this->clearCache();
        return $user;
    }

    public function update($data)
    {
        $user = User::find($data['id']);
        $user?->update($data);
        $this->clearCache($data['id']);
        return $user;
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user?->delete();
        $this->clearCache($id);
        return $user;
    }

    public function clearCache($id = null)
    {
        Cache::forget($this->cacheKey);
        if ($id) {
            Cache::forget("{$this->cacheKey}.{$id}");
        }
    }
}
