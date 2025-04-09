# SmartEV Monitor ⚡🚗

**SmartEV Monitor** é uma aplicação web interativa que simula o painel digital de um carro elétrico, utilizando tecnologias web e simulação de dados via ficheiros `.txt`. O objetivo é representar um cenário realista de um sistema IoT com sensores e atuadores monitorizados em tempo real.

---

## 🧩 Funcionalidades Principais

- Interface moderna e responsiva 
- Leitura de sensores em tempo real (temperatura, potência e bateria)
- Visualização de atuadores (portas, luzes, segurança)
- Representação gráfica dos valores históricos (Chart.js)
- Separação visual entre sensores e atuadores
- Histórico interativo com tabela + gráfico
- API local em PHP para registo de valores

---

## 🗂️ Estrutura do Projeto

```
SmartEV/
├── api/              # Endpoints para registo de dados
│   └── api.php
├── css/              # Estilos personalizados
│   └── dashboard.css
    └── login.css
├── img/              # Logotipos e imagens
├── index.php         # Página de login
├── logout.php        # Encerrar sessão
├── dashboard.php     # Painel principal com sensores e atuadores
├── historico.php     # Página de histórico com gráfico
├── README.md         # Documentação do projeto
└── api/files/        # Simulação de sensores (valores e logs)
    ├── temperatura/
    ├── potencia/
    ├── bateria/
    └── ...
```

---

## 🛠️ Tecnologias Utilizadas

- **Frontend:** HTML5, CSS3, Bootstrap 5, Chart.js, Material Design Icons
- **Backend:** PHP 8.x
- **Simulação IoT:** Leitura e escrita em ficheiros `.txt` locais

---

## 🚀 Como Executar Localmente

### 1. Clonar o repositório
```bash
git clone https://github.com/seu-usuario/SmartEV.git
cd SmartEV
```

### 2. Colocar o projeto no ambiente local
Se estiveres a usar MAMP:
```
/Applications/MAMP/htdocs/SmartEV
```

### 3. Aceder via navegador
```
http://localhost:8888/SmartEV/index.php
```

---

## 👨‍💻 Colaboração

- Faz pull antes de começares:
  ```bash
  git pull
  ```
- Após alterações:
  ```bash
  git add .
  git commit -m "Descrição da alteração"
  git push
  ```

---

## 🔐 Sessões & Segurança

- A autenticação é gerida por sessão (`index.php` e `logout.php`)
- Os dados são simulados e não devem ser expostos num servidor online

---

## 🔮 Melhorias Futuras

- Integração com sensores reais (Arduino, Raspberry Pi)
- Gestão de utilizadores (admin, normal)
- Painel de controlo remoto com comandos
- Exportação de dados (CSV, JSON)
- Alertas e notificações

---

## 📝 Licença

MIT — podes usar e modificar com atribuição de crédito.
