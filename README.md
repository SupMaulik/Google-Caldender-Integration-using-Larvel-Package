<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Manage events on a Google Calendar

Latest Version on Packagist Software License Test Status Code Style Status Total Downloads

This package makes working with a Google Calendar a breeze. Once it has been set up you can do these things:

use Spatie\GoogleCalendar\Event;

//create a new event
$event = new Event;

$event->name = 'A new event';
$event->description = 'Event description';
$event->startDateTime = Carbon\Carbon::now();
$event->endDateTime = Carbon\Carbon::now()->addHour();
$event->addAttendee([
    'email' => 'john@example.com',
    'name' => 'John Doe',
    'comment' => 'Lorum ipsum',
]);
$event->addAttendee(['email' => 'anotherEmail@gmail.com']);
$event->addMeetLink(); // optionally add a google meet link to the event

$event->save();

// get all future events on a calendar
$events = Event::get();

// update existing event
$firstEvent = $events->first();
$firstEvent->name = 'updated name';
$firstEvent->save();

$firstEvent->update(['name' => 'updated again']);

// create a new event
Event::create([
   'name' => 'A new event',
   'startDateTime' => Carbon\Carbon::now(),
   'endDateTime' => Carbon\Carbon::now()->addHour(),
]);

// delete an event
$event->delete();

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects on our website.
Support us

We invest a lot of resources into creating best in class open source packages. You can support us by buying one of our paid products.

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on our contact page. We publish all received postcards on our virtual postcard wall.
Installation

You can install the package via composer:

composer require spatie/laravel-google-calendar

You must publish the configuration with this command:

php artisan vendor:publish --provider="Spatie\GoogleCalendar\GoogleCalendarServiceProvider"

This will publish a file called google-calendar.php in your config-directory with these contents:

return [

    'default_auth_profile' => env('GOOGLE_CALENDAR_AUTH_PROFILE', 'service_account'),

    'auth_profiles' => [

        /*
         * Authenticate using a service account.
         */
        'service_account' => [
            /*
             * Path to the json file containing the credentials.
             */
            'credentials_json' => storage_path('app/google-calendar/service-account-credentials.json'),
        ],

        /*
         * Authenticate with actual google user account.
         */
        'oauth' => [
            /*
             * Path to the json file containing the oauth2 credentials.
             */
            'credentials_json' => storage_path('app/google-calendar/oauth-credentials.json'),

            /*
             * Path to the json file containing the oauth2 token.
             */
            'token_json' => storage_path('app/google-calendar/oauth-token.json'),
        ],
    ],

    /*
     *  The id of the Google Calendar that will be used by default.
     */
    'calendar_id' => env('GOOGLE_CALENDAR_ID'),
];

How to obtain the credentials to communicate with Google Calendar

The first thing you’ll need to do is get credentials to use Google's API. I’m assuming that you’ve already created a Google account and are signed in. Head over to Google API console and click "Select a project" in the header.

1

Next up we must specify which APIs the project may consume. From the header, select "Enable APIs and Services".

2

On the next page, search for "Calendar" and select "Google Calendar API" from the list.

3

From here, press "Enable" to enable the Google Calendar API for this project.

4

Now that you've created a project that has access to the Calendar API it's time to download a file with these credentials. Click "Credentials" in the sidebar and then press the "Credentials in APIs & Services" link.

5

From this page, open the "Create credentials" drop-down and select "Service account key".

6

On the next screen, you can give the service account a name. You can name it anything you’d like. In the service account id you’ll see an email address. We’ll use this email address later on in this guide. Select "JSON" as the key type and click "Create" to download the JSON file. You will get a warning that the service account does not have a role, you can safely ignore this and create the service account without assigning a role.

If you have delegated domain-wide access to the service account and you want to impersonate a user account, specify the email address of the user account in the config file.

7

Save the json inside your Laravel project at the location specified in the service_account_credentials_json key of the config file of this package. Because the json file contains potentially sensitive information, I don't recommend committing it to your git repository.

Now that everything is set up on the API site, we’ll need to configure some things on the Google Calendar site. Head over to Google Calendar and view the settings of the calendar you want to work with via PHP. On the "Share with specific people" tab press the "Add people" button and add the service account id that was displayed when creating credentials on the API site.

8

9

Scroll down to the "Integrate calendar" section to see the id of the calendar. You need to specify that id in the config file.

10
Authentication with OAuth2

This package supports OAuth2 authentication. This allows you to authenticate with an actual Google account, and to create and manage events with your own Google account.

OAuth2 authentication requires a token file, in addition to the credentials file. The easiest way to generate both of these files is by using the php quickstart tool. Following this guide will generate two files, credentials.json and token.json. They must be saved to your project as oauth-credentials.json and oauth-token.json, respectively. Check the config file in this package for exact details on where to save these files.

To use OAuth2, you must also set a new environment variable in your .env file:

GOOGLE_CALENDAR_AUTH_PROFILE=oauth

If you are upgrading from an older version of this package, you will need to force a publish of the configuration:

php artisan vendor:publish --provider="Spatie\GoogleCalendar\GoogleCalendarServiceProvider" --force

Finally, for a more seamless experience in your application, instead of using the quickstart tool you can set up a consent screen in the Google API console. This would allow non-technical users of your application to easily generate their own tokens. This is completely optional.
Usage
Getting events

You can fetch all events by simply calling Event::get(); this will return all events of the coming year. An event comes in the form of a Spatie\GoogleCalendar\Event object.

The full signature of the function is:

public static function get(Carbon $startDateTime = null, Carbon $endDateTime = null, array $queryParameters = [], string $calendarId = null): Collection

The parameters you can pass in $queryParameters are listed on the documentation on list at the Google Calendar API docs.
Accessing start and end dates of an event

You can use these getters to retrieve start and end date as Carbon instances:

$events = Event::get();

$events[0]->startDate;
$events[0]->startDateTime;
$events[0]->endDate;
$events[0]->endDateTime;

Creating an event

You can just new up a Spatie\GoogleCalendar\Event-object

$event = new Event;

$event->name = 'A new event';
$event->startDateTime = Carbon\Carbon::now();
$event->endDateTime = Carbon\Carbon::now()->addHour();

$event->save();

You can also call create statically:

Event::create([
   'name' => 'A new event',
   'startDateTime' => Carbon\Carbon::now(),
   'endDateTime' => Carbon\Carbon::now()->addHour(),
]);

This will create an event with a specific start and end time. If you want to create a full-day event you must use startDate and endDate instead of startDateTime and endDateTime.

$event = new Event;

$event->name = 'A new full day event';
$event->startDate = Carbon\Carbon::now();
$event->endDate = Carbon\Carbon::now()->addDay();

$event->save();

You can create an event based on a simple text string like this:

$event = new Event();

$event->quickSave('Appointment at Somewhere on April 25 10am-10:25am');

// statically
Event::quickCreate('Appointment at Somewhere on April 25 10am-10:25am');

Getting a single event

Google assigns a unique id to every single event. You can get this id by getting events using the get method and getting the id property on a Spatie\GoogleCalendar\Event-object:

// get the id of the first upcoming event in the calendar.
$eventId = Event::get()->first()->id;

// you can also get the id after creating the event, then you can save it to database.
$event = new Event;
$newEvent = $event->save();
echo $newEvent->id; // displey the event id

You can use this id to fetch a single event from Google:

Event::find($eventId);

Updating an event

Easy, just change some properties and call save():

$event = Event::find($eventId);

$event->name = 'My updated title';
$event->save();

Alternatively, you can use the update method:

$event = Event::find($eventId)

$event->update(['name' => 'My updated title']);

Deleting an event

Nothing to it!

$event = Event::find($eventId);

$event->delete();

Setting a source

You can set source urls in your events, which are only visible to the creator of the event (see docs for more on the source property). This function only works when authenticated via OAuth.

$yourEvent->source = [
   'title' => 'Test Source Title',
   'url' => 'http://testsource.url',
 ];

Setting a color

You can set certain colors for your events (colorId 1 to 11). The possibilities are limited to the color definitions of the Google Calendar API. You can find them here.

$yourevent->setColorId(11);

Limitations

The Google Calendar API provides many options. This package doesn't support all of them. For instance, recurring events cannot be managed properly with this package. If you stick to creating events with a name and a date you should be fine.
Upgrading from v1 to v2

The only major difference between v1 and v2 is that under the hood Google API v2 is used instead of v1. Here are the steps required to upgrade:

    rename the config file from laravel-google-calendar to google-calendar
    in the config file rename the client_secret_json key to service_account_credentials_json
https://github.com/spatie/laravel-google-calendar