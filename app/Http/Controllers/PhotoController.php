<?php

namespace App\Http\Controllers;

use App\Helpers\Enumerable\Dictionary;
use App\Managers\Photos\IPhotoManager;
use App\ViewModels\Photo\IndexViewModel;
use App\ViewModels\Photo\PhotoListViewModel;
use App\ViewModels\Photo\ShowViewModel;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use function array_key_exists;
use function count;

class PhotoController extends Controller
{
    private ?array $photos;

    public function __construct(IPhotoManager $photoManager)
    {
        $this->photos = Cache::remember('photos', $seconds = 60 * 60 * 24, fn () => $photoManager->all());
    }

    public function index()
    {
        $viewModel = new IndexViewModel();
        $viewModel->pageTitle = 'Photos';

        return view('photos.index', ['viewModel' => $viewModel]);
    }

    public function show(string $identifier)
    {
        $viewModel = new ShowViewModel();
        $viewModel->pageTitle = "Photos | {$identifier}";
        $viewModel->photo = null;
        $viewModel->photoFriendlyName = $identifier;

        if (isset($this->photos) && count($this->photos) > 0) {
            if (!array_key_exists($identifier, $this->photos)) {
                throw new NotFoundHttpException();
            }

            $filePath = $this->photos[$identifier];
            $viewModel->photo = $filePath;
        }

        return view('photos.show', ['viewModel' => $viewModel]);
    }

    public function photos()
    {
        $viewModel = new PhotoListViewModel();
        $viewModel->photos = null;

        if (isset($this->photos) && count($this->photos) > 0) {
            $photos = Dictionary::shuffle($this->photos);
            $viewModel->photos = $photos;
        }

        return view('photos.partial', ['viewModel' => $viewModel]);
    }
}
