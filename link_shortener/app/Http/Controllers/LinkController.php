<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Http\Requests\ImportLinkRequest;

use App\Repositories\LinkRepository;
use App\Repositories\AccessorRepository;

class LinkController extends Controller
{
    protected $link_repository;
    protected $accessor_repository;

    public function __construct(LinkRepository $link_repository, AccessorRepository $accessor_repository)
    {
        $this->link_repository = $link_repository;
        $this->accessor_repository = $accessor_repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('links.index', ['links' => $this->link_repository->getAllLinks()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('links.create_edit', ['link' => $this->link_repository->newLink()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLinkRequest $request)
    {
        $link_details = $request->only([
            'url',
            'slug'
        ]);

        if (is_null($link_details['slug']) || empty($link_details['slug'])) {
            $link_details['slug'] = substr(md5(uniqid(mt_rand(), true)) , 0, mt_rand(6,8));
        }

        $link_details['id_user'] = auth()->user()->id;

        $this->link_repository->createLink($link_details);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('links.create_edit', ['link' => $this->link_repository->getLinkById($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLinkRequest $request, $id)
    {
        $link_details = $request->only([
            'url',
            'slug'
        ]);

        if (is_null($link_details['slug']) || empty($link_details['slug'])) {
            $link_details['slug'] = substr(md5(uniqid(mt_rand(), true)) , 0, mt_rand(6,8));
        }

        $this->link_repository->updateLink($link_details, $id);

        return redirect()->route('links.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->link_repository->deleteLink($id);

        return redirect()->route('links.index');
    }

    /**
     * Get the specified link from storage with an slug.
     */
    public function getLinkBySlug($slug)
    {
        $link = $this->link_repository->getLinkBySlug($slug);

        $this->link_repository->incrementLinkAccess($link->id);

        $this->accessor_repository->createAccessor($link->id);

        return redirect()->away($link->url);
    }

    /**
     * Get the specified link from storage with an slug.
     */
    public function importLinks(ImportLinkRequest $request)
    {
        $user = auth()->user();

        $file = fopen($request->file_links, 'r');

        $delimiter = ',';

        if ($file) {

            $header = fgetcsv($file, 0, $delimiter);

            while (!feof($file)) {

                $row = fgetcsv($file, 0, $delimiter);
                if (!$row) {
                    continue;
                }

                $link_details = [
                    'url' => $row[0],
                    'slug' => isset($row[1]) ? $row[1] : '',
                    'id_user' => $user->id
                ];

                if (is_null($link_details['slug']) || empty($link_details['slug'])) {
                    $link_details['slug'] = substr(md5(uniqid(mt_rand(), true)) , 0, mt_rand(6,8));
                }

                $link = $this->link_repository->getLinkBySlug($link_details['slug'], null);

                if (is_null($link) && !is_null($link_details['url']))
                    $this->link_repository->createLink($link_details);
            }
            fclose($file);
        }

        return redirect()->route('links.index');
    }
}
