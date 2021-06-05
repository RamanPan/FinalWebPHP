<?php
    class dbconfig
    {
        public static $dbuser = "postgres";
        public static $dbpass = "1234";
        public static $host = "localhost";
        public static $dbname = "PolyClinic";
    }

    $tables = [
        "patients" => array(
            "id", 
            "name", 
            "phone_number",
            "date_of_birth"
        ),
        "offices" => array(
            "id", 
            "begin_working", 
            "end_working", 
            "phone_number"
        ),
        "price_list" => array (
            "id",
            "service",
            "price"
        ),
        "schedule" => array(
            "id",
            "working_days"
        ),
        "doctors" => array(
            "id",
            "name",
            "speciality",
            "date_of_birth",
            "price_list_id",
            "schedule_id"
        ),
        "appointments" => array(
            "id",
            "date",
            "time",
            "price",
            "doctor_id",
            "office_id",
            "patient_id",
        ),
        "medical_records" => array(
            "id",
            "diagnosis",
            "condition",
            "recommendation",
            "appointment_id"
        )
    ];
?>