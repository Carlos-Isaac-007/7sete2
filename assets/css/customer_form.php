 <style>
 select.form-control {
    height: auto !important;
    min-height: 45px; /* Mantém uma altura mínima sem forçar */
    padding: 10px;
}
.select2-container .select2-selection--single {
    height: auto !important;
    display: flex;
    align-items: center;
    padding: 10px;
}

    /* Estilização moderna para o formulário de edição de cliente */
select {
    height: 45px !important;
}
.user-content {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    margin: 20px auto;
}

.user-content h3 {
    font-size: 22px;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
}

.form-group label {
    font-weight: 500;
    color: #555;
}

.form-control {
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 10px;
    font-size: 16px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
}

textarea.form-control {
    resize: none;
    height: 120px;
}

.btn-primary {
    background-color: rgb(6, 59, 116);
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 8px;
    transition: background 0.3s ease;
}

.btn-primary:hover {
    background: #0056b3;
}
.btn-primary:active {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
.success, .error {
    padding: 12px;
    border-radius: 5px;
    margin-bottom: 15px;
    font-weight: 500;
}

.success {
    background: #d4edda;
    color: #155724;
    border-left: 5px solid #28a745;
}

.error {
    background: #f8d7da;
    color: #721c24;
    border-left: 5px solid #dc3545;
}

@media (max-width: 600px) {
    .user-content {
        padding: 15px;
    }

    .form-control {
        font-size: 14px;
    }

    .btn-primary {
        width: 100%;
    }
     .user-content h3 {
        font-size: 18px; /* Diminui o tamanho do título em telas pequenas */
    }
}
</style> 