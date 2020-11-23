## API
	
	$ php artisan make:controller API/LanguageController --api
	# In the api.php route file
	# Route::apiResource('/languages', 'API\LanguageController');

	# To handel what will be returned in any API request
	$ php artisan make:resource Language

- Do not forget to override the Request `failedValidation` method in Request class, which in our case is `Requests\LanguageRequest`

```php

/** At the top of the class */

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

/** In the class */

/**
	* Handle a failed validation attempt.
	* 
	* Override the parent method action if the request is for AJAX 
	* 
	* @param  \Illuminate\Contracts\Validation\Validator  $validator
	* @return void
	*
	* @throws \Illuminate\Validation\ValidationException
	*/
protected function failedValidation(Validator $validator)
{
	if(\Request::wantsJson()){
		$errors = (new ValidationException($validator))->errors();
		throw new HttpResponseException(response()->json(['errors' => $errors], 400));
	} else {
		parent::failedValidation($validator);
	}
}
```
