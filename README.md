# Task Manager

## Opis projektu
Task Manager to aplikacja do zarządzania zadaniami, umożliwiająca użytkownikom tworzenie, edycję, usuwanie i oznaczanie statusu zadań. Aplikacja posiada funkcje rejestracji i logowania, a każde zadanie jest powiązane z indywidualnym kontem użytkownika.

## Funkcje aplikacji

### 1. Rejestracja i logowanie
Użytkownicy mogą tworzyć konto i logować się, aby uzyskać dostęp do swoich zadań oraz funkcji personalizowanych.

### 2. Zarządzanie profilem użytkownika
Aplikacja umożliwia edycję podstawowych informacji profilowych:
- Zmiana nazwy użytkownika
- Zmiana hasła

### 3. Zarządzanie zadaniami
- **Dodawanie zadań** – użytkownicy mogą tworzyć nowe zadania, podając tytuł i opis.
- **Edycja zadań** – możliwość edycji istniejących zadań.
- **Usuwanie zadań** – usunięcie zadania na stałe.
- **Status zadania** – użytkownicy mogą zmieniać status zadania ("w procesie" / "wykonano").
- **Widok tylko dla zalogowanych** – użytkownik widzi wyłącznie swoje zadania.

## Autor
**Artur Pylypenko** (nr. 44074)

---

## Instalacja i uruchomienie projektu

### Wymagania:
- Zainstalowany **Docker**
- Dostęp do Internetu, aby pobrać niezbędne obrazy Dockera

### Kroki instalacji:
1. **Sklonuj repozytorium:**
   ```sh
   git clone https://github.com/ScandalXD/task-manager.git
   cd task-manager
   ```

2. **Uruchom aplikację za pomocą Docker Compose:**
   ```sh
   docker-compose up --build
   ```

3. **Otwórz aplikację w przeglądarce:**
   - **Frontend i backend**: `http://localhost:8080`

Teraz możesz korzystać z aplikacji Task Manager do zarządzania swoimi zadaniami! 🚀

