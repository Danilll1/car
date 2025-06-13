<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reqw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReqController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        $requests = Reqw::where('id_user', Auth::user()->id)->get();
        return view('req', compact('requests', 'cars'));
    }

    public function store(Request $request)
    {

        $credentials = $request->validate([
            'id_car' => 'required',
            'booking_date' => 'required',
            'prava' => 'required',
            'adress' => 'required',
            'contact' => 'required',
            'prava_date' => 'required',
            'oplata' => 'required',
        ]);
        $credentials['id_user'] = Auth::user()->id;
        $credentials['id_status'] = 1;

        Reqw::create($credentials);

        return redirect('/requests');
    }

    public function destroy($id)
    {
        // Находим заявку по ID или выбрасываем исключение, если не найдена
        $request = Reqw::findOrFail($id);

        // Проверка прав: можно разрешить удаление только владельцу заявки или админу
        if (auth()->user()->isAdmin() || auth()->user()->id === $request->id_user) {
            $request->delete();

            return redirect()->back()->with('success', 'Заявка успешно удалена.');
        } else {
            abort(403, 'У вас нет прав для удаления этой заявки.');
        }
    }
}
