# 📝 COORD. TI - Sistema de Gestão de Chamados

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![MVC](https://img.shields.io/badge/Architecture-MVC-green?style=for-the-badge)

O **COORD. TI** é uma plataforma de Help Desk desenvolvida para gerenciar fluxos de suporte técnico. O projeto foi construído utilizando **PHP Orientado a Objetos** sob a arquitetura **MVC**, aplicando padrões como **Service Layer** e **Repository Pattern**. Este projeto serviu como base sólida para o desenvolvimento de competências em roteamento, autoload, namespaces e segurança antes da transição para o framework Laravel.

---

## 🚀 Tecnologias e Conceitos Aplicados

* **Arquitetura MVC:** Separação clara entre Modelo, Visão e Controle.
* **Camadas Service & Repository:** Lógica de negócio isolada dos acessos ao banco de dados.
* **Autoload & Namespaces:** Organização seguindo o padrão **PSR-4** via Composer.
* **Segurança:** Criptografia de senhas com **Argon2id**.
* **Gestão de E-mail:** Recuperação de senha com **PHPMailer** e integração com **Mailtrap**.
* **Interface:** Design responsivo construído com **Bootstrap 5**.

---

## 🔑 Níveis de Acesso

O sistema gerencia permissões e visibilidade de dados através de três papéis principais:

| Nível | Permissões e Acesso |
| :--- | :--- |
| **Admin** | Acesso completo: Gestão de usuários (CRUD/Soft Delete), designação de atendentes, dashboard global e exclusão de tickets. |
| **Atendente** | Focado na resolução: Visualiza chamados abertos, assume tickets de terceiros e gerencia sua própria fila de atendimentos. |
| **Usuário** | Focado na solicitação: Abre novos chamados, acompanha o progresso e interage com o técnico no chat. |

---

## 📂 Estrutura de Diretórios

```text
├── App
│   ├── Config         # Conexão PDO com o Banco de Dados
│   ├── Controllers    # Orquestração de requisições e fluxo de páginas
│   ├── Models         # Entidades e representação dos dados
│   ├── Repositories   # Persistência e consultas SQL isoladas
│   ├── Services       # Regras de negócio, validações e integrações (Mailtrap)
│   └── Views          # Telas (app), Modais (auth) e Layouts (header/footer)
├── Public
│   ├── Assets         # CSS personalizado, Scripts JS e Imagens
│   └── index.php      # Front Controller (Ponto de entrada do sistema)
├── Vendor             # Dependências gerenciadas pelo Composer
└── .env               # Configurações sensíveis (Banco e SMTP)
