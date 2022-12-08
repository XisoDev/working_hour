# Working_hours from schedule.
Schedule is a package that helps tracking schedules for your models. If you have workers in a company, you can set schedules for them and see their availability though the time.

# Inspiration
This package is inspired from [Spatie's Opening Hours](https://github.com/spatie/opening-hours) package, which uses a schedule but only statically, rather than binding it to a model. This gave me the idea of brining it closer to Eloquent Models than to the classic Class.

# Installation
Install the package via Composer CLI:
```bash
$ composer require xisodev/working_hours
```

For versions of Laravel that doesn't support package discovery, you should add this to your `config/app.php` file, in the `providers` array:
```php
\XisoDev\WorkingHours\ScheduleServiceProvider::class,
```

Publish the migration file and the config file.
```bash
$ php artisan vendor:publish --provider="XisoDev\WorkingHours\ScheduleServiceProvider"
```

Migrate the database.
```bash
$ php artisan migrate
```

Add the trait to your model.
```php
use XisoDev\WorkingHours\Traits\HasSchedule;

class User extends Model {
    use HasSchedule;
    ...
}
```

# Getting Started
To get stared, let's create a schedule for our user. It will be from Monday to Friday, between 8-12 and 13-18.
```php
$user->setSchedule([
    'monday' => ['08:00-12:00', '13:00-18:00'],
    'tuesday' => ['08:00-12:00', '13:00-18:00'],
    'wednesday' => ['08:00-12:00', '13:00-18:00'],
    'thursday' => ['08:00-12:00', '13:00-18:00'],
    'friday' => ['08:00-12:00', '13:00-18:00'],
]);

$user->hasSchedule(); // true
```

Let's  say the user has its birthday on 1st March each year, so let's add this to an exclusions list. Adding to this, the first and the second day of Christmas is free for anyone, and let's add 1st May 2018 in our exclusions list too. 

Note: 1st May 2018 will occur only once, it's not recurrent.
```php
$user->setExclusions([
    '03-01' => ['08:00-12:00'],
    '12-25' => [],
    '12-26' => [],
    '2018-05-01' => [],
]);
```

# Checking for availability
You can check if the user has working hours on a certain day, date. Passing date also works with Carbon instance.
```php
$user->isAvailableOn('monday'); // true
$user->isAvailableOn('05-28'); // true; This is Monday, in 2018 (current year)
$user->isAvailableOn('2018-05-28'); // true
$user->isAvailableOn(Carbon::create(2018, 5, 28, 0, 0, 0)); // true

$user->isUnavailableOn('monday'); // false
$user->isUnavailableOn('05-28'); // false
$user->isUnavailableOn('2018-05-28'); // false
$user->isUnavailableOn(Carbon::create(2018, 5, 28, 0, 0, 0)); // false
```

If there is an exclusion that day, it will return the correct value based on the schedule set that day:
```php
$user->isUnavailableOn('12-25'); // true
$user->isUnavailableOn('03-01'); // false
```

# Checking for availability at a certain time
You can also check availability for a certain time on a specific day.
```php
$user->isAvailableOnAt('monday', '09:00'); // true
$user->isUnavailableOnAt('monday', '09:00'); // false
```

# Getting the amount of hours or minutes for a day
You can get the amount of hours or minutes scheduled for a day. Good for tracking workable hours, for example.
```php
$user->getHoursOn('03-01'); // 4
$user->getHoursOn('12-26'); // 0
$user->getHoursOn('05-28'); // 9
$user->getHoursOn('2018-05-28'); // 9

$user->getMinutesOn('03-01'); // 240
```

# Deleting the schedule
If you plan to delete the user's schedule, you can do so by calling `deleteSchedule()`.
```php
$user->deleteSchedule();
$user->hasSchedule(); // false
```
