<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\TestCase;

abstract class TestCase2 extends TestCase
{
    public function setUp(): void
    {
        $this->setUpDatabase();
        $this->migrateTables();
    }

    protected function setUpDatabase()
    {
        $database = new Manager();
        $database->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $database->bootEloquent();
        $database->setAsGlobal();
    }

    protected function migrateTables()
    {
        Manager::schema()
            ->create('posts',
            function ($table) {
                $table->increments('id');
                $table->string('title');
                $table->timestamps();
            }
        );
    }

    protected function makePost(): Post
    {
        $post = new Post();
        $post->title = 'Título do post';
        $post->save();

        return $post;
    }
}

class Post extends Model
{
    use \Cecez\Dolly\Cacheable;
}