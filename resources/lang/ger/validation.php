<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted" =>"L'attributo :deve essere possibile.",
    "accepted_if" => "L'attributo :deve essere quando :other è :valore.",
    "active_url" => "L'attributo :non è un URL valido.",
    "after" => "L'attributo : deve essere una data successiva a :date.",
    "after_or_equal" => "L'attributo : deve essere una data successiva o uguale a :data.",
    "alpha" => "L'attributo : deve contenere solo lettere.",
    "alpha_dash" => "L'attributo : deve contenere solo lettere, numeri, trattini e trattini bassi.",
    "alpha_num" => "L'attributo : deve contenere solo lettere e numeri.",
    "array" => "L'attributo : deve essere un array.",
    "before" => "L'attributo : deve essere una data precedente a :date.",
    "before_or_equal" => "L'attributo : deve essere una data precedente o uguale a :date.",
    "between" => [
        "numeric" => "L'attributo :deve essere compreso tra :min e :max.",
        "file" => "L'attributo :deve essere compreso tra :min e :max kilobyte.",
        "string" => "L'attributo :deve essere compreso tra :min e :max caratteri.",
        "array" => "L'attributo :deve avere elementi compresi tra :min e :max.",
    ],
    "boolean" => "Il campo :attributo deve essere vero o falso.",
    "confirmed" => "La conferma :attributo non corrisponde.",
    "current_password" => "La password non è corretta.",
    "date" => "L'attributo :non è una data valida.",
    "date_equals" => "L'attributo : deve essere una data uguale a :data.",
    "date_format" => "L'attributo :non corrisponde al formato :format.",
    "different" => "L'attributo :attributo e :altro devono essere diversi.",
    "digits" => "L'attributo :deve essere :cifre cifre.",
    "digits_between" => "L'attributo :deve essere compreso tra :min e :max cifre.",
    "dimensions" => "L'attributo :ha dimensioni dell'immagine non valide.",
    "distinct" => "Il campo :attributo ha un valore duplicato.",
    "email" => "L'attributo : deve essere un indirizzo email valido.",
    "ends_with" => "L'attributo :deve terminare con uno dei seguenti: :valori.",
    "exists" => "L'attributo :selezionato non è valido.",
    "file" => "L'attributo : deve essere un file.",
    "filled" => "Il campo :attributo deve avere un valore.",
    "gt" => [
        "numeric" => "L'attributo :deve essere maggiore di :valore.",
        "file" => "L'attributo :deve essere maggiore di :valore kilobyte.",
        "string" => "L'attributo :deve essere maggiore di :caratteri di valore.",
        "array" => "L'attributo :deve avere più di :elementi di valore.",
    ],
    "gte" => [
        "numeric" => "L'attributo :deve essere maggiore o uguale a :valore.",
        "file" => "L'attributo :deve essere maggiore o uguale a :valore kilobyte.",
        "string" => "L'attributo :deve essere maggiore o uguale a :caratteri di valore.",
        "array" => "L'attributo :deve avere :elementi di valore o più.",
    ],
    "image" =>"L'attributo : deve essere un'immagine.",
    "in" => "L'attributo :selezionato non è valido.",
    "in_array" => "Il campo :attributo non esiste in :altro.",
    "integer" => "L'attributo :deve essere un numero intero.",
    "ip" => "L'attributo : deve essere un indirizzo IP valido.",
    "ipv4" => "L'attributo : deve essere un indirizzo IPv4 valido.",
    "ipv6" => "L'attributo : deve essere un indirizzo IPv6 valido.",
    "json" => "L'attributo : deve essere una stringa JSON valida.",
    "lt" => [
        "numeric" => "L'attributo :deve essere minore di :valore.",
        "file" => "L'attributo :deve essere inferiore a :value kilobyte.",
        "string" => "L'attributo :deve essere inferiore a :caratteri di valore.",
        "array" => "L'attributo :deve avere meno di :elementi di valore.",
    ],
    "lte" => [
        "numeric" => "L'attributo :deve essere minore o uguale a :valore.",
        "file" => "L'attributo :deve essere minore o uguale a :valore kilobyte.",
        "string" => "L'attributo :deve essere minore o uguale a :caratteri di valore.",
        "array" => "L'attributo :non deve contenere più di :elementi di valore.",
    ],
    "max" => [
        "numeric" => "L'attributo :non deve essere maggiore di :max.",
        "file" => "L'attributo :non deve essere maggiore di :max kilobyte.",
        "string" => "L'attributo :non deve essere maggiore di :max caratteri.",
        "array" => "L'attributo :non deve contenere più di :max elementi.",
    ],
    "mimes" => "L'attributo :deve essere un file di tipo: :valori.",
    "mimetypes" => "L'attributo :deve essere un file di tipo: :valori.",
    "min" => [
        "numeric" => "L'attributo :deve essere almeno :min.",
        "file" => "L'attributo :deve essere almeno :min kilobyte.",
        "string" => "L'attributo :deve contenere almeno :min caratteri.",
        "array" => "L'attributo : deve contenere almeno :min elementi.",
    ],
    "multiple_of" => "L'attributo :deve essere un multiplo di :valore.",
    "not_in" => "L'attributo :selezionato non è valido.",
    "not_regex" => "Il formato :attributo non è valido.",
    "numeric" => "L'attributo :deve essere un numero.",
    "password" => "La password non è corretta.",
    "present" => "Il campo :attributo deve essere presente.",
    "regex" => "Il formato :attributo non è valido.",
    "required" => "Il campo :attributo è obbligatorio.",
    "required_if" => "Il campo :attributo è obbligatorio quando :other è :valore.",
    "required_unless" => "Il campo :attributo è obbligatorio a meno che :other sia in :values.",
    "required_with" => "Il campo :attributo è obbligatorio quando è presente :valori.",
    "required_with_all" => "Il campo :attributo è obbligatorio quando sono presenti :valori.",
    "required_without" => "Il campo :attributo è obbligatorio quando :values ​​non è presente.",
    "required_without_all" => "Il campo :attributo è obbligatorio quando nessuno dei :valori è presente.",
    "prohibited" => "Il campo :attributo è vietato.",
    "prohibited_if" => "Il campo :attribute è proibito quando :other è :value.",
    "prohibited_unless" => "Il campo :attribute è proibito a meno che :other non sia in :values.",
    "prohibits" => "Il campo :attributo vieta a :other di essere presente.",
    "same" => "L'attributo :attributo e :altro devono corrispondere.",
    "size" => [
        "numeric" => "L'attributo :deve essere :dimensione.",
        "file" => "L'attributo :deve essere :size kilobyte.",
        "string" => "L'attributo :deve essere :caratteri size.",
        "array" => "L'attributo :deve contenere :taglia articoli.",
    ],
    "starts_with" => "L'attributo :deve iniziare con uno dei seguenti: :valori.",
    "string" => "L'attributo : deve essere una stringa.",
    "timezone" => "L'attributo : deve essere un fuso orario valido.",
    "unique" => "L'attributo :è già stato preso.",
    "uploaded" => "Impossibile caricare l'attributo :.",
    "url" => "L'attributo : deve essere un URL valido.",
    "uuid" => "L'attributo : deve essere un UUID valido.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    "custom" => [
        "attribute-name" => [
            "rule-name" => "messaggio personalizzato",
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    "attributes" => [],

];