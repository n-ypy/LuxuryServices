import pyautogui
import keyboard
import time


def log_pixel_color(x, y, label):
    pixel_color = pyautogui.pixel(x, y)
    print(f"{label} - Pixel color at ({x}, {y}): RGB{pixel_color}")


def get_user_choice():
    print("Выбери пиксели для проверки: ")
    for idx, (_, _, label) in enumerate(positions_to_check, 1):
        print(f"{idx}. Чек {label}")

    choices = input(
        "Введи вариант(ы) через запятую (например, 1,2): ").split(",")
    return [int(choice) for choice in choices if choice.isdigit() and 1 <= int(choice) <= len(positions_to_check)]


def main():
    global positions_to_check
    positions_to_check = [
        (670, 130, "Мини-игра"),
        (1158, 1016, "Полный инвентарь"),
        (115, 40, "Кнопка Е"),
        (1887, 1031, "Рубить дерево")
    ]

    bot_running = False
    key_pressed = False

    if not bot_running:
        selected_positions = get_user_choice()

    while True:
        if keyboard.is_pressed('F4'):
            if not key_pressed:
                bot_running = not bot_running
                print("Ботик запущен!" if bot_running else "Ботик остановлен!")
                key_pressed = True
        else:
            key_pressed = False

        if bot_running:
            for idx in selected_positions:
                x, y, label = positions_to_check[idx - 1]
                log_pixel_color(x, y, label)
                time.sleep(0.5)


if __name__ == "__main__":
    main()
