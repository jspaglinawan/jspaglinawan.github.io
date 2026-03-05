<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>To-Do List</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --bg:           #fff5f0; 
  --surface-1:    #ffe8dc; 
  --surface-2:    #ffdcc9; 
  --surface-3:    #fbc9b0; 
  --border:       rgba(74, 55, 45, 0.1);
  --border-2:     rgba(74, 55, 45, 0.2);
  --text-1:       #4a372d; 
  --text-2:       #7d6356; 
  --text-3:       #a68d81; 
  --violet:       #ff7a5c; 
  --violet-bg:    rgba(255, 122, 92, 0.15);
  --violet-glow:  rgba(255, 122, 92, 0.35);
  --teal:         #2bbbad;
  --teal-bg:      rgba(43, 187, 173, 0.12);
  --rose:         #e56b6f;
  --rose-bg:      rgba(229, 107, 111, 0.12);
  --amber:        #f3a64b;
  --amber-bg:     rgba(243, 166, 75, 0.12);
  --green:        #7fb069;
  --green-bg:     rgba(127, 176, 105, 0.12);
  --r: 14px;
  --r-sm: 8px;
  --r-lg: 20px;
}

html, body {
  height: 100%;
  font-family: 'DM Sans', sans-serif;
  background: var(--bg);
  color: var(--text-1);
  overflow: hidden;
}

.app {
  display: grid;
  grid-template-columns: 260px 1fr;
  height: 100vh;
}

.sidebar {
  background: var(--surface-1);
  border-right: 1px solid var(--border);
  display: flex;
  flex-direction: column;
  padding: 28px 0;
  overflow-y: auto;
  position: relative;
  z-index: 100;
  transition: transform 0.3s ease;
}

.sidebar-logo {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 0 22px 28px;
  border-bottom: 1px solid var(--border);
  margin-bottom: 10px;
}

.logo-mark {
  width: 36px; height: 36px;
  background: linear-gradient(135deg, var(--violet), #ff9a85);
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  box-shadow: 0 4px 14px var(--violet-glow);
  flex-shrink: 0;
}

.logo-mark svg { width: 18px; height: 18px; }
.logo-text { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.1rem; letter-spacing: -0.03em; color: var(--text-1); }
.logo-text span { color: var(--violet); }

.nav-section { padding: 0 12px; flex: 1; }
.nav-label { font-size: 0.67rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; color: var(--text-3); padding: 16px 10px 8px; }

.nav-item {
  display: flex; align-items: center; gap: 10px; padding: 10px 12px;
  border-radius: var(--r-sm); cursor: pointer; transition: all 0.18s;
  font-size: 0.875rem; font-weight: 500; color: var(--text-2); margin-bottom: 2px; position: relative;
}

.nav-item:hover { background: var(--surface-2); color: var(--text-1); }
.nav-item.active { background: var(--violet-bg); color: var(--violet); }
.nav-item.active::before { content: ''; position: absolute; left: 0; top: 20%; bottom: 20%; width: 3px; background: var(--violet); border-radius: 0 3px 3px 0; }

.nav-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.nav-icon svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 1.8; }

.nav-badge { margin-left: auto; background: var(--surface-3); color: var(--text-2); font-size: 0.7rem; font-weight: 700; padding: 2px 7px; border-radius: 100px; min-width: 20px; text-align: center; }
.nav-item.active .nav-badge { background: var(--violet); color: white; }
.category-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }

.main { display: flex; flex-direction: column; overflow: hidden; background: var(--bg); position: relative; }

.topbar {
  display: flex; align-items: center; justify-content: space-between; padding: 22px 36px;
  border-bottom: 1px solid var(--border); background: var(--bg); flex-shrink: 0;
}

.menu-toggle { display: none; background: none; border: none; cursor: pointer; color: var(--text-1); margin-right: 15px; }

.topbar-left h1 { font-family: 'Syne', sans-serif; font-size: 1.5rem; font-weight: 800; letter-spacing: -0.04em; color: var(--text-1); }
.topbar-left p { font-size: 0.8rem; color: var(--text-3); margin-top: 2px; }

.topbar-right { display: flex; align-items: center; gap: 10px; }

.progress-ring-wrap { display: flex; align-items: center; gap: 10px; background: var(--surface-1); border: 1px solid var(--border); border-radius: 100px; padding: 7px 14px 7px 10px; }
.progress-ring-wrap svg { width: 28px; height: 28px; }
.progress-track { fill: none; stroke: var(--surface-3); stroke-width: 3; }
.progress-fill  { fill: none; stroke: var(--violet); stroke-width: 3; stroke-linecap: round; stroke-dasharray: 69.1; stroke-dashoffset: 69.1; transform-origin: center; transform: rotate(-90deg); transition: stroke-dashoffset 0.5s ease; }
.progress-label { font-size: 0.78rem; font-weight: 600; color: var(--text-2); }
.progress-label span { color: var(--violet); }

.btn-icon { width: 38px; height: 38px; border-radius: var(--r-sm); background: var(--surface-1); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.18s; color: var(--text-2); position: relative; }
.btn-icon svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 1.8; }

.content { flex: 1; overflow-y: auto; padding: 28px 36px; }

.stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 28px; }
.stat-card { background: var(--surface-1); border: 1px solid var(--border); border-radius: var(--r); padding: 18px; position: relative; overflow: hidden; transition: all 0.2s; }
.stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; }
.stat-card.violet::before { background: linear-gradient(90deg, var(--violet), #ffb3a1); }
.stat-card.teal::before   { background: linear-gradient(90deg, var(--teal), #67e8f9); }
.stat-card.rose::before   { background: linear-gradient(90deg, var(--rose), #fda4af); }
.stat-card.amber::before  { background: linear-gradient(90deg, var(--amber), #fcd34d); }

.stat-icon { width: 34px; height: 34px; border-radius: var(--r-sm); display: flex; align-items: center; justify-content: center; margin-bottom: 14px; }
.stat-icon svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 1.8; }
.stat-card.violet .stat-icon { background: var(--violet-bg); color: var(--violet); }
.stat-card.teal .stat-icon   { background: var(--teal-bg); color: var(--teal); }
.stat-card.rose .stat-icon   { background: var(--rose-bg); color: var(--rose); }
.stat-card.amber .stat-icon  { background: var(--amber-bg); color: var(--amber); }

.stat-num { font-family: 'Syne', sans-serif; font-size: 1.8rem; font-weight: 800; letter-spacing: -0.04em; line-height: 1; margin-bottom: 4px; }
.stat-label { font-size: 0.76rem; font-weight: 500; color: var(--text-3); }

.add-task-section { background: linear-gradient(135deg, var(--surface-1) 0%, rgba(255, 122, 92, 0.08) 100%); border: 1px solid var(--border); border-radius: var(--r-lg); padding: 20px 24px; margin-bottom: 28px; }
.add-task-label { font-size: 0.72rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; color: var(--violet); margin-bottom: 12px; display: flex; align-items: center; gap: 6px; }
.add-task-label::before { content: ''; width: 16px; height: 2px; background: var(--violet); }

.input-row { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; }
.input-wrap { flex: 2; min-width: 200px; position: relative; }
.input-wrap svg { position: absolute; left: 13px; top: 50%; transform: translateY(-50%); width: 15px; height: 15px; stroke: var(--text-3); fill: none; stroke-width: 2; }

input[type="text"], input[type="date"], select { font-family: 'DM Sans', sans-serif; font-size: 0.875rem; background: #ffffff; border: 1.5px solid var(--border); color: var(--text-1); border-radius: var(--r-sm); padding: 11px 14px 11px 36px; width: 100%; outline: none; transition: all 0.18s; }

.date-wrap, .select-wrap { position: relative; flex: 1; min-width: 140px; }
.date-wrap svg, .select-wrap svg { position: absolute; left: 13px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; stroke: var(--text-3); fill: none; stroke-width: 2; z-index: 1; }

.add-btn { display: flex; align-items: center; justify-content: center; gap: 8px; padding: 11px 22px; background: var(--violet); color: white; border: none; border-radius: var(--r-sm); font-weight: 700; cursor: pointer; transition: all 0.18s; box-shadow: 0 4px 12px var(--violet-glow); white-space: nowrap; }

.task { background: var(--surface-1); border: 1px solid var(--border); border-radius: var(--r); padding: 16px 18px; display: flex; align-items: center; gap: 14px; margin-bottom: 8px; animation: fadeUp 0.3s ease both; }
.task.overdue { border: 2px solid var(--rose); background: #fffafa; }

.cb { width: 22px; height: 22px; border-radius: 6px; border: 2px solid var(--surface-3); display: flex; align-items: center; justify-content: center; cursor: pointer; background: #ffffff; flex-shrink: 0; }
.task.completed .cb { background: var(--green); border-color: var(--green); }
.cb svg { display: none; width: 11px; height: 11px; stroke: white; fill: none; stroke-width: 3; }
.task.completed .cb svg { display: block; }

.task-body { flex: 1; min-width: 0; }
.task-name { font-size: 0.9rem; font-weight: 600; color: var(--text-1); margin-bottom: 5px; overflow-wrap: break-word; }
.tag { display: inline-flex; align-items: center; gap: 5px; font-size: 0.7rem; font-weight: 600; padding: 3px 9px; border-radius: 100px; margin-right: 5px; margin-top: 4px; }
.tag.date { background: var(--surface-3); color: var(--text-2); }

.task-actions { display: flex; align-items: center; gap: 6px; }

.overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.3); z-index: 90; }

@keyframes fadeUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

/* RESPONSIVE DESIGN */
@media (max-width: 1024px) {
  .stats-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 768px) {
  .app { grid-template-columns: 1fr; }
  .sidebar { position: fixed; left: 0; top: 0; bottom: 0; transform: translateX(-100%); width: 260px; }
  .sidebar.open { transform: translateX(0); }
  .overlay.active { display: block; }
  .menu-toggle { display: block; }
  .topbar { padding: 15px 20px; }
  .content { padding: 20px; }
  .progress-ring-wrap { display: none; }
}

@media (max-width: 580px) {
  .stats-grid { grid-template-columns: 1fr; }
  .input-row > * { flex: 1 1 100% !important; }
  .topbar-left h1 { font-size: 1.2rem; }
  .task-actions { flex-direction: column; }
}

.notif-dot { position: absolute; top: 8px; right: 8px; width: 10px; height: 10px; background: var(--rose); border-radius: 50%; border: 2px solid var(--bg); display: none; }
.notif-dot.active { display: block; animation: pulse-red 1.5s infinite; }
@keyframes pulse-red { 0% { box-shadow: 0 0 0 0 rgba(229, 107, 111, 0.7); } 70% { box-shadow: 0 0 0 6px rgba(229, 107, 111, 0); } 100% { box-shadow: 0 0 0 0 rgba(229, 107, 111, 0); } }

.act-btn { width: 30px; height: 30px; border-radius: 6px; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.15s; background: transparent; }
.act-btn svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }
.act-btn.edit { color: var(--amber); } .act-btn.del { color: var(--rose); }

.section-header { display: flex; align-items: center; justify-content: space-between; margin: 20px 0 12px; }
.section-title { display: flex; align-items: center; gap: 10px; font-family: 'Syne', sans-serif; font-size: 0.95rem; font-weight: 700; }
.section-line { width: 18px; height: 3px; border-radius: 2px; }
.section-count { font-size: 0.72rem; font-weight: 700; padding: 3px 9px; border-radius: 100px; background: var(--surface-2); border: 1px solid var(--border); }
.section-toggle { font-size: 0.78rem; font-weight: 600; color: var(--text-3); background: none; border: none; cursor: pointer; display: flex; align-items: center; gap: 5px; }
.empty-state { display: flex; flex-direction: column; align-items: center; padding: 36px 0; color: var(--text-3); }
</style>
</head>
<body>

<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<div class="app">
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
      <div class="logo-mark">
        <svg viewBox="0 0 18 18" fill="none" stroke="white" stroke-width="2" stroke-linecap="round">
          <path d="M3 5h12M3 9h8M3 13h5"/>
          <circle cx="15" cy="13" r="2.5" fill="white" stroke="none"/>
          <path d="M14 12.8l.7.7 1.3-1.3" stroke="#7c6af7" stroke-width="1.5"/>
        </svg>
      </div>
      <span class="logo-text">Task<span>Menu</span></span>
    </div>

    <nav class="nav-section">
      <div class="nav-label">Menu</div>
      <div class="nav-item active" id="nav-dashboard" onclick="filterTasks('all')">
        <div class="nav-icon"><svg viewBox="0 0 16 16"><rect x="2" y="2" width="5" height="5" rx="1"/><rect x="9" y="2" width="5" height="5" rx="1"/><rect x="2" y="9" width="5" height="5" rx="1"/><rect x="9" y="9" width="5" height="5" rx="1"/></svg></div>
        Dashboard <span class="nav-badge" id="nb-all">0</span>
      </div>
      <div class="nav-item" onclick="filterTasks('today')">
        <div class="nav-icon"><svg viewBox="0 0 16 16"><rect x="2" y="3" width="12" height="11" rx="1.5"/><line x1="5" y1="1.5" x2="5" y2="4.5"/><line x1="11" y1="1.5" x2="11" y2="4.5"/><line x1="2" y1="7" x2="14" y2="7"/></svg></div>
        Today <span class="nav-badge" id="nb-today">0</span>
      </div>
      <div class="nav-item" onclick="filterTasks('overdue')">
        <div class="nav-icon" style="color:var(--rose)"><svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="6"/><line x1="8" y1="5" x2="8" y2="8.5"/><circle cx="8" cy="11" r="0.75" fill="currentColor"/></svg></div>
        Overdue <span class="nav-badge" id="nb-overdue">0</span>
      </div>
      <div class="nav-item" onclick="filterTasks('completed')">
        <div class="nav-icon" style="color:var(--green)"><svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="6"/><polyline points="5,8 7,10 11,6"/></svg></div>
        Completed <span class="nav-badge" id="nb-done">0</span>
      </div>

      <div class="nav-label">Categories</div>
      <div class="nav-item" onclick="filterTasks('personal')"><span class="category-dot" style="background:var(--violet)"></span> Personal</div>
      <div class="nav-item" onclick="filterTasks('work')"><span class="category-dot" style="background:var(--teal)"></span> Work</div>
      <div class="nav-item" onclick="filterTasks('health')"><span class="category-dot" style="background:var(--green)"></span> Health</div>
      <div class="nav-item" onclick="filterTasks('learning')"><span class="category-dot" style="background:var(--amber)"></span> Learning</div>
    </nav>
  </aside>

  <main class="main">
    <header class="topbar">
      <div style="display: flex; align-items: center;">
        <button class="menu-toggle" onclick="toggleMenu()">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
        <div class="topbar-left">
          <h1>My Tasks</h1>
          <p id="today-date">Loading date…</p>
        </div>
      </div>
      <div class="topbar-right">
        <div class="progress-ring-wrap">
          <svg viewBox="0 0 28 28">
            <circle class="progress-track" cx="14" cy="14" r="11"/>
            <circle class="progress-fill" id="prog-circle" cx="14" cy="14" r="11"/>
          </svg>
          <div class="progress-label" id="prog-label"><span>0%</span> done</div>
        </div>
        <div class="btn-icon" id="notif-bell" onclick="showOverdueAlert()">
          <div id="overdue-notif" class="notif-dot"></div>
          <svg viewBox="0 0 16 16"><path d="M8 2a4 4 0 0 1 4 4v3l1 1.5H3L4 9V6a4 4 0 0 1 4-4z"/><line x1="8" y1="14" x2="8" y2="14.5" stroke-linecap="round" stroke-width="2"/></svg>
        </div>
      </div>
    </header>

    <div class="content">
      <div class="stats-grid">
        <div class="stat-card violet"><div class="stat-icon"><svg viewBox="0 0 16 16"><rect x="2" y="2" width="12" height="12" rx="2"/><line x1="5" y1="8" x2="11" y2="8"/><line x1="8" y1="5" x2="8" y2="11"/></svg></div><div class="stat-num" id="s-total">0</div><div class="stat-label">Total Tasks</div></div>
        <div class="stat-card teal"><div class="stat-icon"><svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="6"/><polyline points="5,8 7,10 11,6"/></svg></div><div class="stat-num" id="s-done">0</div><div class="stat-label">Completed</div></div>
        <div class="stat-card rose"><div class="stat-icon"><svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="6"/><line x1="8" y1="5" x2="8" y2="9"/><circle cx="8" cy="11" r=".8" fill="currentColor"/></svg></div><div class="stat-num" id="s-overdue">0</div><div class="stat-label">Overdue</div></div>
        <div class="stat-card amber"><div class="stat-icon"><svg viewBox="0 0 16 16"><rect x="2" y="3" width="12" height="11" rx="1.5"/><line x1="5" y1="1.5" x2="5" y2="4.5"/><line x1="11" y1="1.5" x2="11" y2="4.5"/><line x1="2" y1="7" x2="14" y2="7"/></svg></div><div class="stat-num" id="s-pending">0</div><div class="stat-label">Pending</div></div>
      </div>

      <div class="add-task-section">
        <div class="add-task-label">Add New Task</div>
        <div class="input-row">
          <div class="input-wrap"><svg viewBox="0 0 16 16"><line x1="4" y1="8" x2="12" y2="8"/><line x1="8" y1="4" x2="8" y2="12"/></svg><input type="text" id="taskInput" placeholder="What needs to be done?"></div>
          <div class="date-wrap"><svg viewBox="0 0 16 16"><rect x="2" y="3" width="12" height="11" rx="1.5"/><line x1="5" y1="1.5" x2="5" y2="4.5"/><line x1="11" y1="1.5" x2="11" y2="4.5"/><line x1="2" y1="7" x2="14" y2="7"/></svg><input type="date" id="dueDate"></div>
          <div class="select-wrap"><svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="2"/><path d="M8 2v1M8 13v1M2 8h1M13 8h1"/></svg>
            <select id="categorySelect">
              <option value="">Category</option><option value="personal">Personal</option><option value="work">Work</option><option value="health">Health</option><option value="learning">Learning</option>
            </select>
          </div>
          <button class="add-btn" onclick="addTask()">Add Task</button>
        </div>
      </div>

      <div id="pending-section">
        <div class="section-header"><div class="section-title"><div class="section-line" style="background:var(--violet)"></div>Pending</div><span class="section-count" id="pending-count-label">0 tasks</span></div>
        <div id="pendingList"></div>
      </div>

      <div id="completed-section">
        <div class="section-header"><div class="section-title"><div class="section-line" style="background:var(--green)"></div>Completed</div><button class="section-toggle open" id="completed-toggle" onclick="toggleCompleted()">Hide</button></div>
        <div id="completedList"></div>
      </div>
    </div>
  </main>
</div>

<script>
let allTasks = [];
let completedVisible = true;
let activeFilter = 'all';

function toggleMenu() {
  document.getElementById('sidebar').classList.toggle('open');
  document.getElementById('overlay').classList.toggle('active');
}

document.addEventListener("DOMContentLoaded", () => {
  const d = new Date();
  document.getElementById("today-date").textContent = d.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
  loadTasks();
});

function loadTasks() {
  fetch("read.php").then(r => r.json()).then(data => { allTasks = data.tasks || []; render(); }).catch(() => render());
}

function addTask() {
  const nameInput = document.getElementById('taskInput'), dateInput = document.getElementById('dueDate'), catSelect = document.getElementById('categorySelect');
  if (!nameInput.value.trim()) return;
  allTasks.push({ id: Date.now(), task_name: nameInput.value, due_date: dateInput.value, category: catSelect.value, status: 'Pending' });
  nameInput.value = ''; dateInput.value = ''; catSelect.value = ''; render();
}

function toggleTask(id) { allTasks = allTasks.map(t => t.id === id ? { ...t, status: t.status === 'Completed' ? 'Pending' : 'Completed' } : t); render(); }
function deleteTask(id) { if (confirm("Delete this task?")) { allTasks = allTasks.filter(t => t.id !== id); render(); } }
function editTask(id, currentName) { const newName = prompt("Edit task name:", currentName); if (newName) { allTasks = allTasks.map(t => t.id === id ? { ...t, task_name: newName } : t); render(); } }

function toggleCompleted() {
  completedVisible = !completedVisible;
  document.getElementById('completedList').style.display = completedVisible ? 'block' : 'none';
  document.getElementById('completed-toggle').textContent = completedVisible ? 'Hide' : 'Show';
}

function showOverdueAlert() {
  const today = new Date().toISOString().split('T')[0];
  const overdue = allTasks.filter(t => t.status !== "Completed" && t.due_date && t.due_date < today);
  if (overdue.length === 0) alert("No overdue tasks.");
  else alert(`OVERDUE:\n${overdue.map(t => `• ${t.task_name}`).join('\n')}`);
}

function render() {
  const today = new Date().toISOString().split('T')[0];
  const pending = allTasks.filter(t => t.status !== "Completed"), completed = allTasks.filter(t => t.status === "Completed"), overdue = pending.filter(t => t.due_date && t.due_date < today), todayTasks = pending.filter(t => t.due_date === today);

  document.getElementById("s-total").textContent = allTasks.length;
  document.getElementById("s-done").textContent = completed.length;
  document.getElementById("s-overdue").textContent = overdue.length;
  document.getElementById("s-pending").textContent = pending.length;
  document.getElementById("overdue-notif").classList.toggle('active', overdue.length > 0);

  const pct = allTasks.length ? Math.round((completed.length / allTasks.length) * 100) : 0;
  document.getElementById("prog-circle").style.strokeDashoffset = (2 * Math.PI * 11) * (1 - pct / 100);
  document.getElementById("prog-label").innerHTML = `<span>${pct}%</span> done`;

  let showP = pending, showC = completed;
  if (activeFilter === 'today') { showP = todayTasks; showC = []; }
  else if (activeFilter === 'overdue') { showP = overdue; showC = []; }
  else if (['personal','work','health','learning'].includes(activeFilter)) { showP = pending.filter(t => t.category === activeFilter); showC = completed.filter(t => t.category === activeFilter); }

  renderList("pendingList", showP, today);
  renderList("completedList", showC, today);
}

function renderList(id, tasks, today) {
  const el = document.getElementById(id);
  if (!tasks.length) { el.innerHTML = `<div class="empty-state">No tasks here</div>`; return; }
  el.innerHTML = tasks.map(t => {
    const isOver = t.due_date && t.due_date < today && t.status !== "Completed";
    return `
    <div class="task ${t.status === 'Completed' ? 'completed' : ''} ${isOver ? 'overdue' : ''}">
      <div class="cb" onclick="toggleTask(${t.id})"><svg viewBox="0 0 12 12"><polyline points="1.5,6 4.5,9.5 10.5,2.5"/></svg></div>
      <div class="task-body">
        <div class="task-name">${t.task_name} ${isOver ? '(OVERDUE)' : ''}</div>
        <div class="task-meta">${t.due_date ? `<span class="tag date">${formatDate(t.due_date)}</span>` : ''}${t.category ? `<span class="tag ${t.category}">${t.category}</span>` : ''}</div>
      </div>
      <div class="task-actions">
        <button class="act-btn edit" onclick="editTask(${t.id}, '${t.task_name}')"><svg viewBox="0 0 14 14"><path d="M9.5 2.5l2 2L4 12H2v-2L9.5 2.5z"/></svg></button>
        <button class="act-btn del" onclick="deleteTask(${t.id})"><svg viewBox="0 0 14 14"><polyline points="2.5,4 11.5,4"/><path d="M4.5 4V3h5v1"/><path d="M3.5 4l1 8h6l1-8"/></svg></button>
      </div>
    </div>`;
  }).join('');
}

function formatDate(d) { if (!d) return ''; const [y, m, day] = d.split('-'); return new Date(y, m - 1, day).toLocaleDateString('en-US', { month: 'short', day: 'numeric' }); }

function filterTasks(type) {
  activeFilter = type;
  document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
  const target = Array.from(document.querySelectorAll('.nav-item')).find(el => el.textContent.toLowerCase().includes(type) || (type === 'all' && el.id === 'nav-dashboard'));
  if (target) target.classList.add('active');
  if (window.innerWidth <= 768) toggleMenu();
  render();
}
</script>
</body>
</html>