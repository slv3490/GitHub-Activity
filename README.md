# 📝 GitHub Activity CLI

Una sencilla interfaz de línea de comandos escrita en PHP que permite obtener y visualizar la actividad reciente de cualquier usuario de GitHub directamente desde la terminal.

---

## 🚀 Descripción

Este proyecto permite consultar la actividad más reciente de un usuario en GitHub utilizando la API pública de GitHub. Fue desarrollado como una práctica para reforzar habilidades en:

- Programación con PHP
- Uso de APIs REST
- Manejo de datos JSON
- Creación de scripts CLI sin frameworks

---

## 🛠️ Requisitos

- Entorno de línea de comandos (Terminal, CMD, PowerShell, etc.)
- [Php](https://www.php.net/) 8.1 o superior ()

---

## 🧰 Instalación

Clonar el repositorio:
   ```bash
   git clone https://github.com/slv3490/GitHub-Activity.git
   
   cd .\GitHub-Activity\

   ```
   ---

## ⚙️ Uso

Ejecuta el script desde la terminal pasando como argumento el nombre de usuario de GitHub:

```bash
php github-activity.php <username>

```

#### Ejemplo:

```
php github-activity.php facebook

```

#### Salida esperada:

```
User Name: "sakthivelan21" 

facebook/hhvm: https://github.com/facebook/hhvm 
Commits: Se han realizado 1 commits
Description: A virtual machine for executing programs written in Hack.
Issues Abiertas: 539
Creado el dia: 2010-01-02T01:17:06Z
Actualizado el dia: 2025-05-31T05:18:23Z

```

---

## 📂 Estructura del Proyecto

```
rastreador-tareas/
│
├── github-activity.php     # Archivo donde se almacenan las funcionalidades
└── README.md               # README archivo
```
---

## ❗ Manejo de errores

El script maneja adecuadamente casos como:

- Nombre de usuario inválido
- Errores de conexión a la API
- Respuestas inesperadas

---

## 📚 Recursos

- [Documentación oficial de la API de GitHub](https://docs.github.com/en/rest/activity/events?apiVersion=2022-11-28)

---
## 🧑‍💻 Autor

- [Roadmap.sh](https://roadmap.sh/projects/github-user-activity)