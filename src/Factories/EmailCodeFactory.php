<?php

namespace Papalapa\Laravel\EmailCodes\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Papalapa\Laravel\EmailCodes\Models\EmailCode;
use Papalapa\Laravel\EmailCodes\Services\CodeGenerator;

final class EmailCodeFactory extends Factory
{
    protected $model = EmailCode::class;

    public function create($attributes = [], ?Model $parent = null): Collection|EmailCode
    {
        return parent::create($attributes, $parent);
    }

    public function make($attributes = [], ?Model $parent = null): Collection|EmailCode
    {
        return parent::make($attributes, $parent);
    }

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'email' => $this->faker->email,
            'code' => CodeGenerator::generateStatic(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ];
    }
}
