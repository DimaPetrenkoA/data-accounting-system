<?php

use App\Orchid\Screens\LogsListScreen;
use App\Orchid\Screens\MainScreen;
use App\Orchid\Screens\FactScreen;
use App\Orchid\Screens\EmailSenderScreen;
use App\Orchid\Screens\OtherScreen;
use App\Orchid\Screens\Work\AddAllowedWorkRangeScreen;
use App\Orchid\Screens\Work\AllowedWorkRangesListScreen;
use App\Orchid\Screens\Work\WorkListScreen;
use App\Orchid\Screens\Work\WorkEditScreen;
use App\Orchid\Screens\Summary\SummaryListScreen;
use App\Orchid\Screens\Summary\SummaryEditScreen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::screen('/main', MainScreen::class)
->name('platform.main')
->breadcrumbs(function (Trail $trail) {
  $trail->push('Главная', route('platform.main'));
});

Route::screen('logs', LogsListScreen::class)
->name('logs.index')
->breadcrumbs(function (Trail $trail) {
  return $trail
  ->parent('platform.index')
  ->push('Лог действий пользователей', route('logs.index'));
});

Route::screen('/fact', FactScreen::class)
->name('platform.fact')
->breadcrumbs(function (Trail $trail) {
  return $trail
  ->parent('platform.index')
  ->push('Факты', route('platform.fact'));
});

Route::screen('email', EmailSenderScreen::class)
->name('platform.email')
->breadcrumbs(function (Trail $trail){
  return $trail
  ->parent('platform.index')
  ->push('Электронная почта', route('platform.email'));
});

Route::screen('/other', OtherScreen::class)
->name('other.forms')
->breadcrumbs(function (Trail $trail) {
  return $trail
  ->parent('platform.index')
  ->push('Текстовые редакторы', route('other.forms'));
});

Route::screen('works', WorkListScreen::class)
->name('works.index')
->breadcrumbs(function (Trail $trail) {
  return $trail
  ->parent('platform.index')
  ->push('Перечень работ', route('works.index'));
});

Route::screen('work/{work?}', WorkEditScreen::class)
->name('work.edit')
->breadcrumbs(function (Trail $trail, $work = null) {
  return $trail
  ->parent('works.index')
  ->push("Работа", route('work.edit', $work));
});

Route::screen('allowedWork-ranges', AllowedWorkRangesListScreen::class)
->name('allowedWork.ranges')
->breadcrumbs(function (Trail $trail) {
  return $trail
  ->parent('platform.index')
  ->push('Работодатели', route('allowedWork.ranges'));
});

Route::screen('allowedWork-addRange', AddAllowedWorkRangeScreen::class)
->name('allowedWork.addRange')
->breadcrumbs(function (Trail $trail) {
  return $trail
  ->parent('allowedWork.ranges')
  ->push('Работодатель', route('allowedWork.addRange'));
});

Route::screen('summarys', SummaryListScreen::class)
->name('summarys.index')
->breadcrumbs(function (Trail $trail) {
  return $trail
  ->parent('platform.index')
  ->push('Хранилище анкет', route('summarys.index'));
});

Route::screen('summary/{summary?}', SummaryEditScreen::class)
->name('summary.edit')
->breadcrumbs(function (Trail $trail, $summary = null) {
  return $trail
  ->parent('summarys.index')
  ->push("Анкета", route('summary.edit', $summary));
});

Route::get('proccess', function() {

  return 'test';
});
