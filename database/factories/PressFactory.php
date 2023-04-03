<?php

namespace Database\Factories;

use App\Models\Press;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Press::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        
        $post = collect($this->faker->paragraphs(rand(5, 15)))
        ->map(function($item){
            return "<p>$item</p>";
        })->toArray();

        $post = implode($post);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $post,
            'image' => '/images/1.jpg',// 
            // 'image' => 'images/'.$this->faker->image('public/images',640,480, null, false),// 
            'tag' => Str::random(10),
            'visibility' => "public",
            'published_on' => now(),
            'featured' => true,
            'source' => "medium",
        ];
    }
}
