<?php

use App\Tag;
use App\User;
use App\Album;
use App\Image;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $faker;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Factory::create();

        $user = factory(User::class, 10)->create();
        foreach (range(1, 50) as $key) {
            factory(Tag::class)->create([
                'user_id' => $user->random()->id
            ]);
        }

        $tags = Tag::all();

        foreach (range(1, 10) as $key) {
            $album = factory(Album::class)->create([
                'user_id' => $user_id = $user->random()->id
            ]);

            $album->tags()->sync($tags->random(3)->pluck('id')->toArray(), [
                'user_id' => $user_id
            ]);
        }

        $albums = Album::all();

        foreach ($albums as $album) {
            // crea 10 immagini
            foreach (range(1, 10) as $key) {
                $image = factory(Image::class)->create([
                    'user_id' => $user_id = $user->random()->id,
                ]);

                $image->albums()->attach($album->id);

                $image->tags()->sync($tags->random(3)->pluck('id')->toArray(), [
                    'user_id' => $user_id
                ]);

                $image->addMediaFromUrl($this->faker->imageUrl(400, 300, 'abstract', true, str_random(4)))
                    ->toMediaCollection();
            }

            $tags = Tag::all();
        }
    }
}
