<?php

namespace App\Repositories;

use App\Models\ToDoList;
use Carbon\Carbon;
use Image;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
/**
 * Class ToDoListRepository
 * @package App\Repositories
 */
class ToDoListRepository
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getToDoList()
    {
        return ToDoList::where('user_id',auth()->user()->id)->with('tag')->paginate(5);
    }


    /**
     * @param string $title
     * @param string $text
     * @param $image
     * @param $date
     * @param string $status
     * @param array $tagId
     * @return ToDoList
     */
    public function addToDoList(string $title, string $text, $image, $date, string $status, array $tagId)
    {
        $input['image'] = time() . '.' . $image->getClientOriginalExtension();

        $destinationPath = public_path('/thumbnail');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $input['image']);
        $destinationPath = public_path('/uploads');
        $image->move($destinationPath, $input['image']);


        $addToDoList = new ToDoList();
        $addToDoList->title = $title;
        $addToDoList->text = $text;
        $addToDoList->image = $input['image'];
        $addToDoList->date = Carbon::parse($date)->format('Y-m-d');
        $addToDoList->status = $status;
        $addToDoList->user_id = auth()->user()->id;
        $addToDoList->save();

        $addToDoList->tag()->sync($tagId);
        return $addToDoList;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTags()
    {
        return Tag::all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteToDoList(int $id)
    {
        return ToDoList::where('id',$id)->delete();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function editToDoList(int $id)
    {
        return ToDoList::where('id',$id)->with('tag')->get();
    }

    /**
     * @param string $title
     * @param string $text
     * @param $image
     * @param $date
     * @param string $status
     * @param array $tagId
     * @param int $id
     * @return mixed
     */
    public function updateToDoList(string $title, string $text, $image, $date, string $status, array $tagId, int $id)
    {
        if(!empty($image))
        {
            $input['image'] = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/thumbnail');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['image']);
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $input['image']);
        }



        $editToDoList = ToDoList::where('id',$id)->first();
        $editToDoList->title = $title;
        $editToDoList->text = $text;
        if(!empty($input['image']))
        {
            $editToDoList->image = $input['image'];
        }
        $editToDoList->date = Carbon::parse($date)->format('Y-m-d');
        $editToDoList->status = $status;
        $editToDoList->user_id = auth()->user()->id;
        $editToDoList->save();

        $editToDoList->tag()->sync($tagId);
        return $editToDoList;
    }

    /**
     * @param $search
     * @param $tagId
     * @return mixed
     */
    public function searchToDoList($search, $tagId)
    {
        return ToDoList::where('user_id',auth()->user()->id)
        ->where('title', 'LIKE', $search.'%')
        ->whereHas('tag', function($q) use($tagId){
            if(!empty($tagId))
            {
                foreach ($tagId as $value)
                {
                    $q->orWhere('tag_name', 'like', $value.'%');
                }
            }
    })->with('tag')->paginate(5);
    }

    /**
     * @param int $toId
     * @return mixed
     */
    public function deleteImage( int $toId)
    {
       $data = ToDoList::where('id',$toId)->first();
       $data->image = null;
       $data->save();
       return $data;
    }
}
