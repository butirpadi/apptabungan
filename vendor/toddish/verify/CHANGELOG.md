# Changelog

If there are no installation instructions provided, assume a ```composer update``` will suffice.

## v2.3.0
+ Added `has` method to Role class.

### Credits
[NoelDavies](https://github.com/NoelDavies) for #30.

## v2.2.2
+ Added cascade clause for migration's foreign keys.

### Credits
[Asilbalaban](https://github.com/asilbalaban) for #29.

## v2.2.1
+ Removed reliance on hard-coded primary key.

### Credits
[DyeH](https://github.com/DyeH) for #27.

## v2.2.0
+ Moved seeding to Seeder class.
+ Removed illuminate/support dependency.

### Credits
[GlobeView](https://github.com/GlobeView) for #25.
[mpemberton5](https://github.com/mpemberton5) for #24.

## v2.1.1
+ Refactored to use LSB.

### Credits
[ronaldcastillo](https://github.com/ronaldcastillo) for #23.

## v2.1.0
+ Updated session key to reflect Laravel core changes.

### Credits
[xLink](https://github.com/xLink) for #22.
[pidgpowell](https://github.com/pidgpowell) for #21.

## v2.0.2
+ Updated Readme to include a reference to the license.
+ Removed unecessary variable.

### Credits
[claar](https://github.com/claar) for #18.

## v2.0.1
+ Updated Readme with new version.

## v2.0.0
+ Removed delete column and adds soft delete.
+ Removed deleted scope methods - use ->trashed() instead.

### Credits
[senei](https://github.com/senei) for #8.
[driesvints](https://github.com/driesvints) for #6.
[tlgreg](https://github.com/tlgreg) for #11.

## v1.1.1
+ Fixed prefix not working in the Base Model.
+ Changed insert to insertGetId.

### Credits
[underparnv](https://github.com/underparnv) for #5.

## v1.1.0
+ Added model scopes to the User model.