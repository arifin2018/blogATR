<?php

namespace App\Http\Controllers;

use App\book;
use App\Http\Requests\UserBookValidation;
use App\Http\Requests\UserValidation;
use App\Http\Resources\User;
use App\Http\Resources\UserResource;
use App\User as AppUser;
use Illuminate\Http\Request;
use \App\Http\Resources\Book as BookResource;
use Exception;

class UserController extends Controller
{
    /**
    *    @OA\Get(
    *       path="/",
    *       tags={"User"},
    *       operationId="User All",
    *       summary="User",
    *       description="Mengambil Data Semua User",
    *       @OA\Response(
    *           response="200",
    *           description="Ok",
    *           @OA\JsonContent
    *           (example={
    *               "data": {
    *                   {
    *                   "id": 6,
    *                   "name": "azriel",
    *                   "email": "azriel@lenna.ai",
    *                   "book": {},
    *                   "created_at": "2024-02-20T04:23:35.000000Z",
    *                   "updated_at": "2024-02-20T04:23:35.000000Z"
    *                  }
    *              }
    *          }),
    *      ),
    *  )
    */
    public function index()
    {
        return User::collection(AppUser::all());
    }

    /**
    *    @OA\Get(
    *       path="/{id}",
    *       tags={"User"},
    *       operationId="User By Id",
    *       summary="User",
    *       description="Mengambil Data Dari ID User",
    *     @OA\Parameter(
    *         description="Parameter ID User",
    *         in="path",
    *         name="id",
    *         required=true,
    *         @OA\Schema(type="string"),
    *         @OA\Examples(example="int", value="1", summary="An int value."),
    *     ),
    *       @OA\Response(
    *           response="200",
    *           description="Ok",
    *           @OA\JsonContent
    *           (example={
    *               "data": {
    *                   "id": 6,
    *                   "name": "azriel",
    *                   "email": "azriel@lenna.ai",
    *                   "book": {},
    *                   "created_at": "2024-02-20T04:23:35.000000Z",
    *                   "updated_at": "2024-02-20T04:23:35.000000Z"
    *              }
    *          }),
    *      ),
    *  )
    */
    public function findById(AppUser $id)
    {
        try {
            return new User($id);
        } catch (\Throwable $e) {
            throw new Exception("User Not Found", 1);

        }
    }

    /**
    *    @OA\Post(
    *       path="/",
    *       tags={"User"},
    *       operationId="Create User",
    *       summary="User",
    *       description="Membuat Data User",
    *     @OA\RequestBody(
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="name",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="email",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="password",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="password_confirmation",
    *                     type="string"
    *                 ),
    *                 example={"name": "Jessica Smith","email": "arifin@gmail.com", "password": "arifin12","password_confirmation":"arifin12"}
    *             )
    *         )
    *     ),
    *       @OA\Response(
    *           response="200",
    *           description="Ok",
    *           @OA\JsonContent
    *           (example={
    *               "data": {
    *                   "id": 6,
    *                   "name": "azriel",
    *                   "email": "azriel@lenna.ai",
    *                   "book": {},
    *                   "created_at": "2024-02-20T04:23:35.000000Z",
    *                   "updated_at": "2024-02-20T04:23:35.000000Z"
    *              }
    *          }),
    *      ),
    *  )
    */
    public function create(UserValidation $UserValidation)
    {
        $data = $UserValidation->all();
        $user = AppUser::create($data);
        return new User($user);
    }

    /**
    *    @OA\Post(
    *       path="/createBook",
    *       tags={"Book"},
    *       operationId="Create Book",
    *       summary="Book",
    *       description="Membuat Data Book",
    *     @OA\RequestBody(
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="user_id",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="name",
    *                     type="string"
    *                 ),
    *                 example={"user_id": "1","name": "arifin"}
    *             )
    *         )
    *     ),
    *       @OA\Response(
    *           response="200",
    *           description="Ok",
    *           @OA\JsonContent
    *           (example={
    *               "data": {
    *                   "name": "azriel",
    *                   "user_id": "6"
    *              }
    *          }),
    *      ),
    *  )
    */
    public function createBook(UserBookValidation $userBookValidation)
    {
        $data = $userBookValidation->all();
        $book = book::create($data);
        return new BookResource($book);
    }

    /**
    *    @OA\Put(
    *       path="/",
    *       tags={"Book"},
    *       operationId="Update Book",
    *       summary="Book",
    *       description="Membuat Data Book",
    *     @OA\Parameter(
    *         description="Parameter ID Book",
    *         in="path",
    *         name="id",
    *         required=true,
    *         @OA\Schema(type="string"),
    *         @OA\Examples(example="int", value="1", summary="An int value."),
    *     ),
    *     @OA\RequestBody(
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="user_id",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="name",
    *                     type="string"
    *                 ),
    *                 example={"user_id": "1","name": "arifin"}
    *             )
    *         )
    *     ),
    *       @OA\Response(
    *           response="200",
    *           description="Ok",
    *           @OA\JsonContent
    *           (example={
    *               "data": {
    *                   "name": "azriel",
    *                   "user_id": "6"
    *              }
    *          }),
    *      ),
    *  )
    */
    public function update(UserBookValidation $userBookValidation, book $book)
    {
        $dataBookUpdate = $userBookValidation->all();
        $dataBook = $book->first();
        $dataBook->update($dataBookUpdate);
        return new BookResource(new book($dataBookUpdate));
    }

    /**
    *    @OA\Put(
    *       path="/{id}",
    *       tags={"User"},
    *       operationId="Remove User",
    *       summary="User",
    *       description="Membuat Data User",
    *     @OA\Parameter(
    *         description="Parameter ID User",
    *         in="path",
    *         name="id",
    *         required=true,
    *         @OA\Schema(type="string"),
    *         @OA\Examples(example="int", value="1", summary="An int value."),
    *     ),
    *       @OA\Response(
    *           response="200",
    *           description="Ok",
    *           @OA\JsonContent
    *           (example={
    *               "data": {}
    *          }),
    *      ),
    *  )
    */
    public function destroy(AppUser $id)
    {
        $idBook = [];
        $data = $id::with('book')->first();
        foreach ($data->book as $key => $value) {
            array_push($idBook, $value->id);
        }
        book::destroy($idBook);
        $data->delete();
        return response()->json();
    }


}
