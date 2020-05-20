<?php


use App\Channel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChannelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel = Channel::create([
            'name' => 'Laravel 5.8',
            'slug'  =>  Str::slug('Laravel 5.8', '-')
        ]);

        $channel = Channel::create([
            'name' => 'Vue Js',
            'slug'  =>  Str::slug('Vue js', '-')
        ]);

        $channel = Channel::create([
            'name' => 'Angular 8',
            'slug'  =>  Str::slug('Angular 8', '-')
        ]);

        $channel = Channel::create([
            'name' => 'Node Js',
            'slug'  =>  Str::slug('Node Js', '-')
        ]);
    }
}
