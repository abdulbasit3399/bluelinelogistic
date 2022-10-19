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

    'accepted' =>' :  屬性必須被接受。',
    'accepted_if' => '當 : other 是 : value 時，必須接受 : attribute。',
    'active_url' => ': attribute 不是有效的 URL。',
    'after' => ':  屬性必須是 : date 之後的日期。',
    'after_or_equal' => ':  屬性必須是晚於或等於 : date 的日期。',
    'alpha' => ' :  屬性只能包含字母。',
    'alpha_dash' => ':  屬性只能包含字母、數字、破折號和下劃線。',
    'alpha_num' => ':  屬性只能包含字母和數字。',
    'array' => ' :  屬性必須是一個數組。',
    'before' => ':  屬性必須是 : date 之前的日期。',
    'before_or_equal' => ':  屬性必須是早於或等於 : date 的日期。',
    'between' => [
        'numeric' => ':  屬性必須介於 : min 和 : max 之間。',
        'file' => ' :  屬性必須介於 : min 和 : max 千字節之間。',
        'string' => ' :  屬性必須介於 : min 和 : max 字符之間。',
        'array' => ':  屬性必須在 : min 和 : max 項之間。',
    ],
    'boolean' => ':  屬性字段必須為真或假。',
    'confirmed' => ':  屬性確認不匹配。',
    'current_password' => '密碼不正確。',
    'date' => ' :  屬性不是有效日期。',
    'date_equals' => ':  屬性必須是等於 : date 的日期。',
    'date_format' => ':  屬性與格式 : format 不匹配。',
    'different' =>' : 屬性和 : other 必須不同。',
    'digits' => ' : 屬性必須是 : digits 數字。',
    'digits_between' => ' : 屬性必須介於 : min 和 : max 位數之間。',
    'dimensions' => ': 屬性的圖像尺寸無效。',
    'distinct' => ': 屬性字段有重複值。',
    'email' => ': 屬性必須是有效的電子郵件地址。',
    'ends_with' => ': 屬性必須以下列之一結尾: : 值。',
    'exists' => '選定的 : 屬性無效。',
    'file' => ' : 屬性必須是文件。',
    'filled' => ': 屬性字段必須有一個值。',
    'gt' => [
        'numeric' =>' : 屬性必須大於 : 值。',
        'file' => ' : 屬性必須大於 : value 千字節。',
        'string' => ' : 屬性必須大於 : 值字符。',
        'array' => ' : 屬性必須有多個 : 值項。',
    ],
    'gte' => [
        'numeric' => ': 屬性必須大於或等於 : 值。',
        'file' => ' : 屬性必須大於或等於 : value 千字節。',
        'string' => ' : 屬性必須大於或等於 : 值字符。',
        'array' => ' : 屬性必須有 : 值項或更多。',
    ],
    'image' =>': 屬性必須是圖像。',
    'in' => '選定的 : 屬性無效。',
    'in_array' => ' : 屬性字段在 : 其他中不存在。',
    'integer' => ' : 屬性必須是整數。',
    'ip' => ': 屬性必須是有效的 IP 地址。',
    'ipv4' => ': 屬性必須是有效的 IPv4 地址。',
    'ipv6' => ': 屬性必須是有效的 IPv6 地址。',
    'json' => ': 屬性必須是有效的 JSON 字符串。',
    'lt' => [
        'numeric' =>' : 屬性必須小於 : 值。',
        'file' => ' : 屬性必須小於 : value 千字節。',
        'string' => ' : 屬性必須小於 : 值字符。',
        'array' => ' : 屬性必須小於 : 值項。',
    ],
    'lte' => [
        'numeric' => ' : 屬性必須小於或等於 : 值。',
        'file' => ' : 屬性必須小於或等於 : value 千字節。',
        'string' => ' : 屬性必須小於或等於 : 值字符。',
        'array' => ': 屬性不得超過 : 值項。',
    ],
    'max' => [
        'numeric' =>' : 屬性不得大於 : max.',
        'file' => '：屬性不得大於：最大千字節。',
        'string' => '：屬性不得大於：最大字符數。',
        'array' => ': 屬性不能超過 : max items。',
    ],
    'mimes' =>': 屬性必須是文件類型: : 值。',
    'mimetypes' => ': 屬性必須是文件類型: : 值。',
    'min' => [
        'numeric' =>': 屬性必須至少為 : min.',
        'file' =>  ' : 屬性必須至少為 : min 千字節。',
        'string' =>  ' : 屬性必須至少為 : min 個字符。',
        'array' =>  ': 屬性必須至少有 : min 個項目。',
    ],
    'multiple_of' => ': 屬性必須是 : 值的倍數。',
    'not_in' => '選定的 : 屬性無效。',
    'not_regex' => ': 屬性格式無效。',
    'numeric' => ' : 屬性必須是數字。',
    'password' => '密碼不正確',
    'present' => ' : 屬性字段必須存在。',
    'regex' => ': 屬性格式無效。',
    'required' => ' : 屬性字段是必需的。',
    'required_if' => '當 : other 是 : value 時需要 : 屬性字段。',
    'required_unless' => ' : 屬性字段是必需的，除非 : other 在 : values 中。',
    'required_with' => '當存在 : 值時需要 : 屬性字段。',
    'required_with_all' => '當存在 : 值時需要 : 屬性字段。',
    'required_without' => '當 : 值不存在時需要 : 屬性字段。',
    'required_without_all' => '當不存在 : 值時需要 : 屬性字段。',
    'prohibited' => ' : 屬性字段被禁止。',
    'prohibited_if' => '當：其他為：值時，禁止屬性字段。',
    'prohibited_unless' => ' : 屬性字段是禁止的，除非 : other 在 : values 中。',
    'prohibits' => ' : 屬性字段禁止 : other 出現。',
    'same' => ' : 屬性和 : other 必須匹配。',
    'size' => [
        'numeric' => ' : 屬性必須是 : 大小。',
        'file' => ' : 屬性必須是 : size 千字節。',
        'string' => ' : 屬性必須是 : size 個字符。',
        'array' => ' : 屬性必須包含 : 尺寸項目。',
    ],
    'starts_with' => ': 屬性必須以下列之一開頭: : 值。',
    'string' => ': 屬性必須是字符串。',
    'timezone' => ': 屬性必須是有效的時區。',
    'unique' => ' : 屬性已被佔用。',
    'uploaded' => ': 屬性上傳失敗。',
    'url' => ': 屬性必須是有效的 URL。',
    'uuid' => ': 屬性必須是有效的 UUID。',

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

    'custom' => [
        'attribute-name' => [
            'rule-name' => '自定義消息',
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

    'attributes' => [],

];