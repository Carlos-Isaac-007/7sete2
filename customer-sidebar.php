    <style>
        .container-perfil {
            width: 90%;
            max-width: 400px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            margin: 20px auto;
        }
        .profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile i {
            font-size: 50px;
            color: rgb(6, 59, 116);
        }
        .profile-name {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .menu-item-perfil {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-decoration: none;
            color: #333;
            font-size: 16px;
            cursor: pointer;
            background-color: rgb(6, 59, 116);
            color: white;
            border-radius: 5px;
            margin: 5px 0;
        }
        .menu-item-perfil i {
            margin-right: 10px;
            font-size: 18px;
        }
        .menu-item-perfil:hover {
            background: #0056b3;
            color: #fff !important;
        }
        .content {
            display: none;
            margin-top: 20px;
            padding: 15px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        @media (min-width: 600px) {
            .container-perfil {
                max-width: 500px;
            }
            .profile i {
                font-size: 60px;
            }
            .profile-name {
                font-size: 20px;
            }
            .menu-item-perfil {
                font-size: 18px;
            }
        }
        @media (min-width: 1024px) {
            .container-perfil {
                max-width: 600px;
                padding: 30px;
            }
            .profile i {
                font-size: 70px;
            }
            .profile-name {
                font-size: 22px;
            }
            .menu-item-perfil {
                font-size: 20px;
                padding: 15px;
            }
        }
    </style>
    
    <div class="container-perfil">
        <div class="profile">
            <i class="fas fa-user-circle"></i>
            <div class="profile-name"><?php echo isset($_SESSION['customer']['cust_name']) ? $_SESSION['customer']['cust_name'] : 'Nome do Usuário'; ?></div>
        </div>
        
        <a href="<?=ROOT?>home" class="menu-item-perfil"><i class="fas fa-home"></i> Página Inicial</a>
        <a href="<?=ROOT?>customer-profile-update" class="menu-item-perfil"><i class="fas fa-user-edit"></i> Perfil</a>
        <a href="<?=ROOT?>customer-billing-shipping-update" class="menu-item-perfil"><i class="fas fa-credit-card"></i> <?php echo LANG_VALUE_88; ?></a>
        <a href="<?=ROOT?>customer-password-update" class="menu-item-perfil"><i class="fas fa-key"></i> Senha</a>
        <a href="<?=ROOT?>customer-order" class="menu-item-perfil"><i class="fas fa-box"></i> <?php echo LANG_VALUE_24; ?></a>
        <a href="<?=ROOT?>logout" class="menu-item-perfil"><i class="fas fa-sign-out-alt"></i> <?php echo LANG_VALUE_14; ?></a>
    </div>
