# The database Structure

### users
```php
   id();
   string('email')->unique();
   timestamp('email_verified_at')->nullable();
   string('password'); // enrypted
   rememberToken();
   string('username')->unique()->after('id');
   uuid('uuid')->unique()->after('username');
   string('role')->default('user')->after('email');
   decimal('balance', 10, 2)->default(0.00)->after('role');
   timestamps();
```
### rules
```php
   id();
   uuid('uuid')->unique();
   string('title');
   text('content')->nullable();
   integer('order_index')->nullable();
   timestamps();
```
