<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToDoListRequest;
use App\Repositories\ToDoListRepository;
use Illuminate\Support\Facades\Redirect;
use Image;

use Illuminate\Http\Request;

/**
 * Class ToDoListController
 * @package App\Http\Controllers
 */
class ToDoListController extends BaseController
{
    /**
     * @var ToDoListRepository
     */
    private ToDoListRepository $toDoListRepository;

    /**
     * ToDoListController constructor.
     * @param ToDoListRepository $toDoListRepository
     */
    public function __construct(ToDoListRepository $toDoListRepository)
    {
        $this->toDoListRepository = $toDoListRepository;
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getToDoList()
    {
        $toDoLists = $this->toDoListRepository->getToDoList();
        return view('home', compact('toDoLists'));
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getToDoListt()
    {
        return $this->toDoListRepository->getToDoList();
    }

    /**
     * @param ToDoListRequest $request
     */
    public function addToDoList(ToDoListRequest $request)
    {
        $this->toDoListRepository->addToDoList($request->title, $request->text, $request->file('image'), $request->date, $request->status, $request->tag_id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTags()
    {
        return $this->toDoListRepository->getTags();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteToDoList(request $request)
    {
        $this->toDoListRepository->deleteToDoList($request->to_do_id);
        return Redirect::back()->with('msg', 'The Message');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function editToDoList($id)
    {
        return $this->toDoListRepository->editToDoList($id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function updateToDoList(request $request, $id)
    {
        return $this->toDoListRepository->updateToDoList($request->title, $request->text, $request->file('image'), $request->date, $request->status, $request->tag_id, $id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function searchToDoList(request $request)
    {
        $toDoLists = $this->toDoListRepository->searchToDoList($request->search, $request->tag_id);
        return view('home', compact('toDoLists'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function deleteImage(request $request)
    {
        return $this->toDoListRepository->deleteImage($request->toId);
    }


}
