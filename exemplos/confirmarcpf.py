import tkinter as tk
import requests

def validar_cpf():
    cpf = entry_cpf.get()
    if cpf:
        url = f"https://api.cinedsoti.com.br/?acao=validarCPF&cpf={cpf}"
        headers = {
                        'Accept': 'application/json',
                        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36'
        }
 # Adicionando cabeçalho Accept
        try:
            response = requests.get(url, headers=headers)
            if response.status_code == 200:
                try:
                    data = response.json()
                    if 'error' in data:
                        resultado_var.set(f"Erro: {data['error']}")
                    else:
                        valido = "válido" if data['valido'] else "inválido"
                        resultado_var.set(f"CPF {cpf} é {valido}.")
                except ValueError:
                    resultado_var.set("Erro: Resposta da API não é JSON.")
                    print("Resposta da API:", response.text)
            else:
                resultado_var.set(f"Erro na API: {response.status_code}")
                print("Texto da resposta:", response.text)
        except Exception as e:
            resultado_var.set(f"Erro na requisição: {e}")
    else:
        resultado_var.set("Por favor, insira um CPF.")



# Criar a janela principal
root = tk.Tk()
root.title("Validador de CPF")

# Definir o tamanho da janela
root.geometry("400x200")  # Largura x Altura

# Configurar o layout
tk.Label(root, text="Insira o CPF:", font=("Arial", 12)).pack(pady=10)
entry_cpf = tk.Entry(root, font=("Arial", 12))
entry_cpf.pack(pady=5)

botao_validar = tk.Button(root, text="Validar CPF", command=validar_cpf, font=("Arial", 12))
botao_validar.pack(pady=10)

resultado_var = tk.StringVar()
resultado_label = tk.Label(root, textvariable=resultado_var, font=("Arial", 12))
resultado_label.pack(pady=10)

# Executar a aplicação
root.mainloop()
