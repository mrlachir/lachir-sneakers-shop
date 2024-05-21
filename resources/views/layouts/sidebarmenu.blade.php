<div class="sidebar" id="sidebar">
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('profile.edit') }}">Profile</a>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</div>

<style>
    .sidebar {
        width: 250px;
        /* Adjust the width of the sidebar */
        position: fixed;
        top: 4rem;
        /* Adjust based on the height of the navbar */
        left: 0;
        height: 100%;
        background-color: #f8fafc;
        border-right: 1px solid #e2e8f0;
        padding-top: 1rem;
    }

    .sidebar a {
        display: block;
        padding: 0.75rem 1rem;
        text-decoration: none;
        color: #4a5568;
    }

    .sidebar a:hover {
        background-color: #edf2f7;
    }
</style>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        // Get the width of the sidebar
        var sidebarWidth = document.getElementById('sidebar').offsetWidth;
        var sidebarTop = document.getElementById('sidebar').offsetWidth;
        // Set the margin-left of the main content
        document.querySelector('.content-sidebar').style.marginLeft = sidebarWidth + 'px';
    });
</script>
