<?php
return [
    "plural_label" => "سجل الانشطة",
    "singular_label" => "النشاط",
    "fields" => [
        "type" => [
            "label" => "نوع النشاط",
        ],
        "description" => [
            "label" => "الوصف",
            "text" => "قام المستخدم @user السجل رقم @id ب@event على @model",
        ],
        "event" => [
            "label" => "الحدث",
        ],
        "subject" => [
            "label" => "الجدول",
        ],
        "subject_id" => [
            "label" => "رقم السجل",
        ],
        "logged_at" => [
            "label" => "تاريج التسجيل",
        ],
        "properties" => [
            "label" => "الحقول",
        ],
        "user" => [
            "label" => "المستخدم",
        ],
        "id" => [
            "label" => "#",
        ],
    ],
    "events" => [
        "created" => "إنشاء",
        "updated" => "تعديل",
        "deleted" => "حذف",
        "login" => "تسجيل دخول",
        "logout" => "تسجيل خروج",
        "restored" => "استعادة",
    ],
    "types" => [
        "access" => "وصول",
        "resource" => "سجل",
        "model" => "سجل",
        "notification" => "إشعارات",
    ],
];
