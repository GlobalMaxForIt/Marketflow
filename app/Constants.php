<?php

namespace App;

class Constants{

    #invetroy uchun type

    const INVENTORY_STORE = 1; // do'konlar magazinlar uchun
    const INVENTORY_ORGANIZATION = 2; // tashkilotlar magazinlar uchun
    const INVENTORY_COMPANY = 3; // Kompaniyalar magazinlar uchun


    #user role uchun

    const SUPERADMIN = 1;  // superadmin
    const ADMIN = 2;  // admin
    const MANAGER = 3;  // manager
    const CASHIER = 4;  // cashier
    const SUPPLIERS = 5;  // suppliers


    #user role uchun ['cash', 'card', 'other']

    const CASH = 0;  // cash
    const CARD = 1;  // card
    const OTHER = 2;  // other


    #inventory types

    const INVENTORY_DELIVERY = 1; //(Yetkazib berish) Mahsulotning bir kompaniya yoki do'kondan boshqa joyga yoki do'konga yetkazib berilishi.
    const RETURN = 2; // (Qaytarish) Mahsulotning qaytarilishi. Masalan, mijozdan qaytarilgan mahsulotlar yoki noto'g'ri jo'natilgan mahsulotlarni qaytarish.
    const STOCK_ADJUSTMENT = 3; // (Inventarizatsiya tuzatish) Zaxira miqdorini tuzatish. Tizimdagi xato yoki inventarizatsiya jarayonida yuzaga kelgan farqlarni tuzatish uchun ishlatiladi.
    const PURCHASE = 4; // (Sotib olish) Mahsulotni yetkazib beruvchidan sotib olish. Bu harakat turini ishlab chiqaruvchilar yoki yetkazib beruvchilar bilan mahsulot olishda qo'llash mumkin.
    const SALE = 5; // (Sotish) Mahsulotning do'kondan yoki inventarizatsiyadan sotilishi. Bu harakat turini sotish jarayonlarida ishlatish mumkin.
    const TRANSFER = 6; // (O'tkazish) Mahsulotning bir do'kondan boshqasiga yoki bir bo'limdan boshqa bo'limga o'tkazilishi.
    const DAMAGE = 7; // (Zarar) Mahsulotning zarar ko'rishi, misol uchun, sifatsiz yoki yaroqsiz holga kelgan mahsulotlar.
    const ADJUSTMENT = 8; // (Korreksiya) Mahsulot miqdorini yoki qiymatini tizimda to'g'rilash.
    const SCRAP = 9; // (Yaroqsiz holga kelgan mahsulotlar) Foydalanuvchi tomonidan yaroqsiz deb topilgan mahsulotlarni tashlash yoki zararsiz holga keltirish.

    #stock_adjustment – bu asosan zaxira miqdorlarini yoki inventarizatsiya holatini tuzatish uchun ishlatiladi.
    #adjustment – bu umumiy tuzatishlar, masalan, narxlar, miqdorlar yoki boshqa parametrlarni tuzatish uchun ishlatiladi.
    #DAMAGE - damage transfer_type yordamida zararlangan mahsulotlar tizimda rasmiylashtiriladi va inventarizatsiya bilan bog'liq o'zgarishlar amalga oshiriladi.
        //Bu turdagi harakatlarni ajratib qo'yish, audit va hisob-kitob jarayonlarida zararni aniqlash va undan samarali foydalanishga yordam beradi.

    # consignment_records // company tomonidan yetkazib berilgan mahsulot to'langan yoki qisman to'lngan va umuman to'lanmaganlik uchun statuslar
    const UNPAID = 1; // to'lanmagan
    const PARTIALLY_PAID = 2; // qisman to'langan
    const PAID = 3; // to'langan

    # gender
    const MALE = 0;
    const FEMALE = 1;

    # gender
    const NOT_ACTIVE = 0;
    const ACTIVE = 1;

    #sales
    const NOT_CHECKLIST = 0;
    const CHECKLIST = 1;
}




?>
