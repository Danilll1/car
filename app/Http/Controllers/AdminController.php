<?php

namespace App\Http\Controllers;

use App\Models\Reqw;
use App\Models\Status;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        $requests = Reqw::all();
        $user = auth()->user()->load('role');
        // 3. Проверка роли
        if (!$user->isAdmin()) {
            \Log::error('Доступ запрещен для пользователя', [
                'user_id' => $user->id,
                'id_role' => $user->id_role,
                'role_code' => optional($user->role)->code
            ]);
            abort(403, 'Вы не администратор!');
        }
        return view('admin', compact('requests', 'statuses'));
    }
    
    public function edit(Request $request)
    {
        $cred = $request->validate([
            'id_status' => 'required',
            'id_user' => 'required',
            'admin_message' => 'required', // валидируем наличие сообщения
        ]);

        // Находим заявку по id_user
        $reqw = Reqw::where('id_user', $request->id_user)->first();

        if (!$reqw) {
            return redirect('/admin')->with('error', 'Заявка не найдена.');
        }

        // Обновляем статус
        $reqw->id_status = $cred['id_status'];

        // Обновляем сообщение администратора
        $reqw->admin_message = $cred['admin_message'];

        $reqw->save();

        return redirect('/admin')->with('success', 'Статус и сообщение обновлены.');
    }

    public function destroy($id)
    {
        $request = Reqw::findOrFail($id);

        // Проверка прав администратора, если нужно
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Нет прав для удаления.');
        }

        $request->delete();

        return redirect('/admin')->with('success', 'Заявка успешно удалена.');
    }
}
