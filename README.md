# SynDrive 🚘

**SynDrive** is a modern web-based dashboard interface for autonomous vehicles, inspired by real in-car digital panels.

It visually monitors real-time sensor data such as battery temperature, humidity, pressure, and velocity.  
The goal is to simulate an IoT-connected cockpit using PHP, HTML, CSS, and Bootstrap.

---

## 🧠 Key Features

- Dark theme with modern UI components
- Real-time sensor status display
- Status-based alert levels (Normal, Moderate, Critical)
- Responsive layout using Bootstrap 5
- Material Design Icons integration
- Simulated sensor data via `.txt` files (can be extended to real APIs)

---

## 📁 Project Structure

```
Syndrive/
├── api/            # PHP endpoints (future integration)
├── dashboard/      # Main interface (dashboard.php)
├── sensores/       # Folders for simulated sensor values
│   ├── temperatura/
│   ├── humidade/
│   └── ...
├── css/
│   └── style.css   # Custom styles
├── img/            # Icons and logos
├── js/             # (Optional) JavaScript scripts
├── index.php       # Landing or login page
├── logout.php      # Ends the user session
└── README.md
```

---

## 🛠️ Tech Stack

- HTML5
- CSS3 / Bootstrap 5
- PHP 8.x
- Material Design Icons (CDN)
- Simulated IoT with `.txt` values

---

## 💻 Getting Started

To run this project on your local machine:

### 1. Clone the repository:
```bash
git clone https://github.com/your-username/Syndrive.git
cd Syndrive
```

### 2. Set up your development environment:
Make sure you're using a local PHP server like **MAMP**, **XAMPP**, **WAMP**, or PHP built-in server.

If using MAMP, move the project to:
```
/Applications/MAMP/htdocs/Syndrive
```

### 3. Open in browser:
Access via your browser:
```
http://localhost/Syndrive/dashboard/dashboard.php
```

---

## 👥 Collaboration

If you're collaborating:

- Clone the repo using `git clone`
- Always pull before you start working:
  ```bash
  git pull
  ```
- After making your changes:
  ```bash
  git add .
  git commit -m "Descrição clara da alteração"
  git push
  ```

---

## 🔒 Session & Security

- Session management is handled in `index.php` and `logout.php`
- Authentication logic can be extended further
- This project is local by default and not meant to be exposed online as-is

---

## 📌 Future Improvements

- Live connection to sensors (ESP32, Raspberry Pi, etc.)
- Admin/user roles
- Chart visualizations
- API layer

---

## 📝 License

MIT License — feel free to use and modify with credit.
