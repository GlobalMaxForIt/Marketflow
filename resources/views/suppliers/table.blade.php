@extends('layouts.table')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Buttons example</h4>
                    <p class="card-title-desc">The Buttons extension for DataTables
                        provides a common set of options, API methods and styling to display
                        buttons on a page that will interact with a DataTable. The core library
                        provides the based framework upon which plug-ins can built.
                    </p>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Funksiya</th>
                                <th>1C</th>
                                <th>MeningOmborim</th>
                                <th>Rozetka POS</th>
                                <th>Frontol</th>
                                <th>Life POS</th>
                                <th>Shtrix-M</th>
                                <th>e-POS</th>
                                <th>Global Service</th>
                                <th>Tavsif</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Sotuvlar va kassa boshqaruvi</td>
                                <td>+</td>
                                <td>+</td>
                                <td>+</td>
                                <td>+</td>
                                <td>+</td>
                                <td>+</td>
                                <td>+</td>
                                <td></td>
                                <td>Kassirlar uchun qulay va tez xizmat ko'rsatishni ta'minlash uchun kassa bilan ishlashning soddaligi va qulayligi</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Inventarizatsiya va tovar zaxiralarini hisobga olish</td>
                                <td>+</td>
                                <td>+</td>
                                <td>+</td>
                                <td>+</td>
                                <td>+</td>
                                <td>+</td>
                                <td></td>
                                <td></td>
                                <td>Do'konlarda mavjud bo'lgan ma'lumotlarning doimiy yangilanishi muhim, bu zaxiralarning yetishmovchiligi yoki ortiqcha to'planishining oldini olish uchun</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Sotuvlar tahlili va hisobotlari</td>
                                <td>+</td>
                                <td>+</td>
                                <td></td>
                                <td></td>
                                <td>+</td>
                                <td>+</td>
                                <td></td>
                                <td></td>
                                <td>Do'kon egalariga qaysi mahsulotlar yaxshiroq sotilayotgani va qaysilari kam sotilayotganini tushunishga yordam beradi</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Buxgalteriya va hisobot tizimlari bilan integratsiya</td>
                                <td>+</td>
                                <td>+</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>+</td>
                                <td></td>
                                <td></td>
                                <td>Buxgalteriya va soliq hisobotini soddalashtirish. Hujjat almashinuvi avtomatizatsiyasi</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Sodiqlik dasturi va chegirmalarni boshqarish</td>
                                <td>+</td>
                                <td>+</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Mijozlarni ushlab qolish va qayta xaridlarni rag'batlantirish</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Bir nechta do'konlarni qo'llab-quvvatlash</td>
                                <td>+</td>
                                <td>+</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Tarmoqdagi bir nechta savdo nuqtalariga ega do'konlar uchun zaxira va sotuvlarni markazlashtirilgan boshqaruv</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Mobil boshqaruv ilovasi</td>
                                <td>+</td>
                                <td>+</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Mobil sharoitda ish yuritish va masofaviy nazorat uchun tizim bilan ishlash</td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>Yagona interfeys orqali buyurtmalarni boshqarish</td>
                                <td></td>
                                <td>+</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Narxlarni taqqoslash, buyurtmalarni tasdiqlash va ularni boshqarish imkoniyatini beruvchi platforma</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Tovarlarni qaytarish va hisobdan chiqarishni boshqarish</td>
                                <td></td>
                                <td>+</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Tovarlarni minimal vaqt bilan qaytarish va hisobdan chiqarish jarayonini qulay amalga oshirish</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Soddaligi: qulay interfeys</td>
                                <td></td>
                                <td>+</td>
                                <td></td>
                                <td></td>
                                <td>+</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Foydalanishning qulayligi va texnik qo'llab-quvvatlash, yangilanishlarsiz foydalanish</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Ko'p foydalanuvchili rejim va huquqlarni taqsimlash</td>
                                <td></td>
                                <td>+</td>
                                <td></td>
                                <td></td>
                                <td>+</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Xodimlar uchun axborot va funksiyalarni cheklash uchun huquqlarni taqsimlash</td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>Onlayn-do'konlar va bozorlarga integratsiya</td>
                                <td></td>
                                <td>+</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Onlayn-savdo do'konlarini rivojlantirishni xohlovchilar uchun ko'p kanalli qo'llab-quvvatlash imkoniyati</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
