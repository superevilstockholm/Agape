<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\News;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = News::class;

    public function definition()
    {
        $title = $this->faker->sentence(6, true);
        $subTitle = $this->faker->sentence(4, true);

        // Buat beberapa poin list
        $listItems = collect(range(1, 3))->map(fn() => "- " . $this->faker->words(3, true))->implode("\n");

        $content = "# {$title}\n\n";
        $content .= "## {$subTitle}\n\n";
        $content .= $this->faker->paragraphs(2, true) . "\n\n";
        $content .= $listItems . "\n\n";
        $content .= $this->faker->paragraphs(2, true);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $content,
            'user_id' => null, // nanti diisi seeder
        ];
    }
}
