<?php
namespace App\Src\Track;

use App\Src\Album\Album;
use App\Src\Category\Category;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class TrackManager
{

    public $uploadPath;

    public $trackPath;

    protected $allowedExtension = ['mp3'];

    private $filesystem;

    private $trackRepository;

    /**
     * @param Filesystem $filesystem
     * @param TrackRepository $trackRepository
     */
    public function __construct(
        Filesystem $filesystem,
        TrackRepository $trackRepository
    ) {
        $this->filesystem = $filesystem;
        $this->trackRepository = $trackRepository;
        $this->setUploadPath(public_path() . '/tracks');
        $this->setTrackPath('/tracks');
    }

    /**
     * @return mixed
     */
    public function getUploadPath()
    {
        return $this->uploadPath;
    }

    /**
     * @param mixed $uploadPath
     */
    private function setUploadPath($uploadPath)
    {
        $this->uploadPath = $uploadPath;
    }

    /**
     * @param $category directory name
     * @return $this
     */
    public function createCategoryDirectory($category)
    {
        if ($this->filesystem->isDirectory($this->getUploadPath() . '/' . $category)) {
            return;
        }

        try {
            $this->filesystem->makeDirectory($this->getUploadPath() . '/' . $category, '0775');
        } catch (\Exception $e) {
            dd('Cannot Create Directory ' . $category);
        }

        return $this;
    }

    /**
     * @param $category category directory name
     * @param $album album directory name
     * @return $this
     */
    public function createAlbumDirectory($category, $album)
    {
        if ($this->filesystem->isDirectory($this->getUploadPath() . '/' . $category . '/' . $album)) {
            return $this;
        }

        try {
            $this->filesystem->makeDirectory($this->getUploadPath() . '/' . $category . '/' . $album, '0775');
        } catch (\Exception $e) {
            dd('Cannot Create Directory ' . $category . '/' . $album);
        }

        return $this;
    }

    /**
     * Get the Track File To Play
     * @param $track
     * @return string
     * @throws \Exception
     */
    public function fetchTrack($track)
    {
        // If the Track's Type is Category
        // Search In Category Folder
        if (is_a($track->trackeable, Category::class)) {

            return $this->getTrackPath() . '/' . $track->trackeable->slug . '/' . $track->url;
        } elseif (is_a($track->trackeable, Album::class)) {

            // or Search In Album Folder
            return $this->getTrackPath() . '/' . $track->trackeable->category->slug . '/' . $track->trackeable->slug . '/' . $track->url;
        } else {

            throw new \Exception('Invalid Class');
        }
    }

    /**
     * @param UploadedFile $file Upload File
     * @param Track $track
     * @return string
     * @throws \Exception
     */
    public function uploadTrack(UploadedFile $file, Track $track)
    {
        // move $track to category folder
        $toDirectory = $this->getUploadPath() . '/';

        if (is_a($track->trackeable, Category::class)) {

            $toDirectory .= $track->trackeable->slug;

        } elseif (is_a($track->trackeable, Album::class)) {

            $toDirectory .= $track->trackeable->category->slug . '/' . $track->trackeable->slug;

        } else {

            throw new \Exception('Invalid Class');
        }
        $toDirectory .= $track->url;

        try {
            $file->move($toDirectory);
        } catch (\Exception $e) {
            return 'Error While Moving File. ' . $e->getMessage();
        }

        return $this;
    }

    /**
     * Get the Directory Name from Full path
     * @param $directory
     * @return array
     */
    public function getDirName($directory)
    {
        $array = explode('/', $directory);
        $dirName = array_pop($array);

        return $dirName;
    }

    /**
     * @return array
     */
    public function getAllowedExtension()
    {
        return $this->allowedExtension;
    }

    /**
     * get relative track path ( For Frontend)
     * @return mixed
     */
    public function getTrackPath()
    {
        return $this->trackPath;
    }

    /**
     * @param mixed $trackPath
     */
    private function setTrackPath($trackPath)
    {
        $this->trackPath = $trackPath;
    }

}