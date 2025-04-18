<?php

namespace App\Policies;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ExpensePolicy
{
    use HandlesAuthorization;

    /**
     * Определяет, может ли пользователь обновлять общие данные расходов.
     */
    public function update(User $user, Expense $expense)
    {
        // Проверка: текущий пользователь должен быть владельцем расхода
        return $user->id === $expense->user_id;
    }

    /**
     * Определяет, может ли пользователь обновлять связанные статьи расходов.
     */
    public function updateItem(User $user, Expense $expense)
    {
        // Проверка: текущий пользователь должен быть владельцем расхода
        return $user->id === $expense->user_id;
    }


    /**
     * Determine whether the user can view any models.
     */
   /* public function viewAny(User $user): bool
    {
        //
    }*/

    /**
     * Determine whether the user can view the model.
     */
    /*public function view(User $user, Expense $expense): bool
    {
        //
    }*/

    /**
     * Determine whether the user can create models.
     */
    /*public function create(User $user): bool
    {
        //
    }*/

    /**
     * Determine whether the user can update the model.
     */
    /*public function update(User $user, Expense $expense): bool
    {
        //
    }*/

    /**
     * Determine whether the user can delete the model.
     */
    /*public function delete(User $user, Expense $expense): bool
    {
        //
    }*/

    /**
     * Determine whether the user can restore the model.
     */
    /*public function restore(User $user, Expense $expense): bool
    {
        //
    }*/

    /**
     * Determine whether the user can permanently delete the model.
     */
    /*public function forceDelete(User $user, Expense $expense): bool
    {
        //
    }*/
}
