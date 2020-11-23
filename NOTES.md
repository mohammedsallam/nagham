##  Notes:

1- use resource controller for each of our components

	$ php artisan make:model Photo -a

	# Set the configratio of your file, add coments demonstarte the use of the field and the use of the table
	# $table->engine = 'InnoDB'; in tables with transactions and relations

	$ php artisan migrate --path database\migrations\2020_03_26_123015_create_photos_table.php

	# move controller to Admin folder 
	# Do not forget to change the namespace of the controller
	$ move app\http\Controllers\PhotoController.php app\http\controllers\admin\
	# Add this line after namespace line
	use App\Http\Controllers\Controller;
	
	# for establishing the Unit Test class of Photos module
	$ php artisan make:test PhotosTest

	# The route in admin group is 
	# Route::resource('photos', 'PhotoController');

	# @method('PUT') in form if this is update form
	
	# Delete any row via ajax request and set method type in the ajax request to `delete`

	# Route in the frontend is module/{id}/{slug?}

2- Each module has 2 tables:
	- Basic info Table like the id, image,published_date, visitors_num, ...ect `pages`
	- Description table, which contains module_id like article_id, language_id: joined with language table, title, description, slug, keywords, meta_description. `EX: pages_description`

	- so consider joining in migeration files, and models

3- Rules of validation done via form request classes to make controller classes clean 
	`$ php artisan make:request PhotoRequest`
	# Please remeber to set the return of method `authorize` in the generated Request class to true
	# Take a look at `LanguageController` And `LanguageRequest`


4- redirect by
	` return redirect('form')->withInput(); `
	and in View
	` <input name="title" class="form-control" value="{{ old('title', 'DBValue') }}" /> `


5- use csrf tokens in forms and ajax requests

6- soft delete & make archive in every page with delete

7- there is `file-manager` to upload and set images in editors and images fields 
`see language.blade.php`

7- in any opertion contains more than one query , use transaction


8- use cursor in retrivig data
```php
foreach (DBRespose->cursor() as $row) {
	//
}
```

9- Pagination

10- Resize Images Helper

```php
/** At the top of the controller */
use App\Helpers\ImageHelper;

/** In the Controller */
$thumbImageURL = ImageHelper::resize($originalImageInPublicDir, 200, 100);

/** Note that the thumbnails uploaded to `uploads/images/thumbnails` */

```

11- Upload Images Helper

``` # You will not need it in dashboard as there is a filemanager ```

```php
/** At the top of the controller */
use App\Helpers\ImageHelper;


/** In the form request class */

public function rules()
{
	return [
		......
		'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	];
}

/** In the Controller */
$uploadedFile = ImageHelper::upload($request->file('image'));

/** Note that the original images uploaded to `uploads/images` and thumbnails uploaded to `uploads/images/thumbnails` */

```
