<?php

namespace App\Http\Controllers;
use App\Repositories\ToDoListRepository;

use Illuminate\Http\Request;

class ToDoListController extends  BaseController
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
    }

    public function getToDoList()
    {
      
        $this->toDoListRepository->getToDoList();
    }

}
