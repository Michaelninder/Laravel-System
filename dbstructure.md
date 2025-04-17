# 📦 Database Structure

### 🧑‍💻 Users Table (``users``)
```php
   id()
   string('username')->unique()->after('id')
   uuid('uuid')->unique()->after('username')
   string('email')->unique()
   timestamp('email_verified_at')->nullable()
   string('password') // encrypted
   rememberToken()
   string('role')->default('user')->after('email') // 'user', 'admin', etc.
   decimal('balance', 10, 2)->default(0.00)->after('role')
   timestamps()
```
### 📜 Rules Table (``rules``)
```php
   id()
   uuid('uuid')->unique()
   string('title')
   text('content')->nullable()
   integer('order_index')->nullable()
   timestamps()
```
### 🎫 Support Tickets Table (``support_tickets``)
```php
   id()
   uuid('uuid')->unique()
   uuid('user_uuid') // refer to users.uuid
   string('subject')
   string('theme')->nullable()
   string('status')->default('open') // open, pending, closed
   timestamps() // created_at = opened, updated_at = last activity
```
### 💬 Support Messages Table (``support_messages``)
```php
   id()
   uuid('uuid')->unique()
   uuid('ticket_uuid') // refer to support_tickets.uuid
   uuid('user_uuid')   // refer to users.uuid
   text('message')
   timestamps()
```
