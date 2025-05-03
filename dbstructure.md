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
## Support System
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
## Forum System
### 🗂️ Forums Table (``forums``)
```php
   id()
   uuid('uuid')->unique()
   string('name')
   text('description')->nullable()
   boolean('is_locked')->default(false)
   integer('order_index')->default(0)
   timestamps()
```
### 📄 Forum Threads Table (``forum_threads``)
```php
   id()
   uuid('uuid')->unique()
   uuid('forum_uuid')  // refer to forums.uuid
   uuid('user_uuid')   // thread author (users.uuid)
   string('title')
   boolean('is_pinned')->default(false)
   boolean('is_locked')->default(false)
   integer('views')->default(0)
   timestamps() // created_at = posted, updated_at = last reply
```
### 💬 Forum Comments Table (``forum_comments``)
```php
   id()
   uuid('uuid')->unique()
   uuid('thread_uuid') // refer to forum_threads.uuid
   uuid('user_uuid')   // refer to users.uuid
   text('body')
   timestamps()
```
### 👍 Forum Votes Table (``forum_votes``)
```php
   id()
   uuid('uuid')->unique()
   uuid('comment_uuid') // refer to forum_comments.uuid
   uuid('user_uuid')    // who voted (users.uuid)
   boolean('is_upvote') // true = upvote, false = downvote
   timestamps()
```

## Changelog
### 📖 Changelogs Table (``changelogs``)
```php
Schema::create('changelogs', function (Blueprint $table) {
    $table->id();
    $table->uuid('uuid')->unique();
    $table->string('title');
    $table->date('date');
    $table->timestamps();
});
```
### 📄 Changelog Changes Table (``changelog_changes``)
```php
Schema::create('changelog_changes', function (Blueprint $table) {
    $table->id();
    $table->uuid('uuid')->unique();
    $table->uuid('changelog_uuid');
    $table->string('type'); // e.g., fix, update, feature, deletion
    $table->string('name');
    $table->text('description')->nullable();
    $table->timestamps();
});
```
