<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\App;
//
class TrackControllerTest extends TestCase
{

    use DatabaseTransactions;

    protected $trackUploader;
    protected $user;
    protected $catName;
    protected $albumName;
    protected $category;

    public function __construct()
    {
        parent::setUp();

        $this->trackUploader = App::make('\App\Src\Track\TrackUploader');
        $user = factory('App\Src\User\User')->make();
        $this->catName =uniqid();
        $this->category = \App\Src\Category\Category::create([
            'name_en'        => $this->catName,
            'name_ar'        => $this->catName,
            'slug'           => str_slug($this->catName),
            'description_ar' => 'description',
            'description_en' => 'description',
        ]);
        $this->user = $this->be($user);

}

    public function testStore()
    {
        //
        if (!file_exists($this->trackUploader->getUploadPath() . '/' . $this->category->slug)) {
            mkdir($this->trackUploader->getUploadPath() . '/' . $this->category->slug);
        }
        $this->visit('/admin/track/create?type=category')
            ->type('category', 'trackeable_type')
            ->type($this->category->id, 'trackeable_id')
            ->attach($this->trackUploader->getUploadPath() . '/test.mp3', 'tracks')
            ->press('Save Draft');

        $this->seeInDatabase('tracks',
            [
                'trackeable_id'    => $this->category->id,
                'trackeable_type'        => 'Category'
            ]);

        $track = \App\Src\Track\Track::where('trackeable_id', $this->category->id)->where('trackeable_type',
            'Category')->first();

        $this->assertFileExists($this->trackUploader->getUploadPath() . '/' . $this->category->slug . '/' . $track->name);

        rmdir($this->trackUploader->getUploadPath() . '/' . $this->category->slug . '/' . $track->slug);
        rmdir($this->trackUploader->getUploadPath() . '/' . $this->category->slug);

        $this->onPage('/admin/track');
    }

}
