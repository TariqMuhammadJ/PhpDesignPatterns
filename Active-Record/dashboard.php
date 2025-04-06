<?php
session_start();

if (isset($_SESSION['user'])) {
    $user_name;
    $user_id;
    $user = $_SESSION['user'];
    foreach ($user as $key => $value){
        setcookie($key, $value, time() + 3600, "/");
        if ($key == "username"){
            $user_name = $value;
        }

        if ($key == "user_id"){
            $user_id = $value;
        }

    }

    

} else {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notely - Simple Note Taking</title>
    <link rel="stylesheet" href="./CSS/normalize.css">
    <link rel="stylesheet" href="./CSS/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="top-bar">
        <div class="drop-down">
            <ul>
                <li> <div class="circle"></div></li>
                <li><?php echo $user_name?></li>
                <li><?php echo $user_id?></li>
                <li>Settings</li>
                <li class="log-out"><button class="logout-btn" id="logout-btn">Logout</button></li>
            </ul>
        </div>
    </div>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1 class="app-title">Notely</h1>
                <button class="new-note-btn">
                    <i class="fas fa-plus"></i>
                    <span>New Note</span>
                </button>
            </div>
            
            <div class="sidebar-search">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" placeholder="Search notes..." class="search-input">
                </div>
            </div>

            <nav class="folders-nav">
                <h2 class="sidebar-section-title">Folders</h2>
                <ul class="folders-list">
                    <li class="folder-item active">
                        <i class="fas fa-book-open"></i>
                        <span>All Notes</span>
                        <span class="note-count">12</span>
                    </li>
                    <li class="folder-item">
                        <i class="fas fa-star"></i>
                        <span>Favorites</span>
                        <span class="note-count">5</span>
                    </li>
                    <li class="folder-item">
                        <i class="fas fa-trash"></i>
                        <span>Trash</span>
                        <span class="note-count">3</span>
                    </li>
                </ul>
            </nav>

            <nav class="notes-nav">
                <h2 class="sidebar-section-title">Recent Notes</h2>
                <ul class="notes-list">
                    <li class="note-item active">
                        <div class="note-item-content">
                            <h3 class="note-title">Project Ideas</h3>
                            <p class="note-preview">Brainstorming session for upcoming web development projects...</p>
                        </div>
                        <div class="note-meta">
                            <span class="note-date">Today</span>
                        </div>
                    </li>
                    <li class="note-item">
                        <div class="note-item-content">
                            <h3 class="note-title">Shopping List</h3>
                            <p class="note-preview">Groceries to buy: milk, eggs, bread, apples, chicken...</p>
                        </div>
                        <div class="note-meta">
                            <span class="note-date">Yesterday</span>
                        </div>
                    </li>
                    <li class="note-item">
                        <div class="note-item-content">
                            <h3 class="note-title">Meeting Notes</h3>
                            <p class="note-preview">Client meeting discussion points and action items...</p>
                        </div>
                        <div class="note-meta">
                            <span class="note-date">Jun 15</span>
                        </div>
                    </li>
                    <li class="note-item">
                        <div class="note-item-content">
                            <h3 class="note-title">Book Recommendations</h3>
                            <p class="note-preview">List of books to read this summer...</p>
                        </div>
                        <div class="note-meta">
                            <span class="note-date">Jun 10</span>
                        </div>
                    </li>
                    <li class="note-item">
                        <div class="note-item-content">
                            <h3 class="note-title">Vacation Plans</h3>
                            <p class="note-preview">Ideas for summer vacation destinations and itinerary...</p>
                        </div>
                        <div class="note-meta">
                            <span class="note-date">Jun 5</span>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">JS</div>
                    <div class="user-details">
                        <span class="user-name">John Smith</span>
                        <span class="account-type">Free Account</span>
                    </div>
                </div>
                <button class="settings-btn">
                    <i class="fas fa-cog"></i>
                </button>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="main-content">
            <header class="note-header">
                <div class="note-actions">
                    <button class="action-btn favorite-btn">
                        <i class="far fa-star"></i>
                    </button>
                    <button class="action-btn share-btn">
                        <i class="fas fa-share-alt"></i>
                    </button>
                    <button class="action-btn delete-btn">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
                <div class="note-info">
                    <span class="note-edited">Edited: Today at 2:45 PM</span>
                </div>
            </header>

            <div class="note-editor">
                <input type="text" class="note-title-input" value="Project Ideas" placeholder="Note title">
                <div class="note-content-area">
                    <textarea class="note-content" placeholder="Start writing your notes here..."># Brainstorming Session for Upcoming Web Development Projects

## Website Redesign Project
- Modern, minimalist aesthetic
- Responsive design for all devices
- Improved navigation structure
- Performance optimization
- Accessibility improvements

## Mobile App Ideas
1. Task management application
   - Simple, clean interface
   - Daily/weekly views
   - Priority levels for tasks
   - Reminder notifications
   - Progress tracking

2. Recipe finder app
   - Search by ingredients
   - Dietary preference filters
   - Save favorite recipes
   - Meal planning integration
   - Nutritional information

## E-commerce Enhancements
- Product recommendation engine
- Customer review system
- Streamlined checkout process
- Inventory management integration
- Analytics dashboard

## Learning Platform Features
- Interactive coding exercises
- Progress tracking for students
- Certificate generation
- Discussion forums
- Video lecture integration

## Things to Research:
- Latest CSS frameworks
- Performance optimization techniques
- Authentication best practices
- Serverless architecture
- Micro-frontend approach
</textarea>
                </div>
            </div>
        </main>
    </div>
    <script src="./JS/logout.js"></script>
</body>
</html>
