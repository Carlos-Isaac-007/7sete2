<style>
     @media (max-width: 576px) {
    .modal-footer {
      flex-direction: column;
    }
    .modal-footer .btn {
      width: 100%;
      margin-bottom: 8px;
    }
  }
  @media (min-width: 768px) {
  .modal-body .d-flex {
    flex-direction: row;
    justify-content: space-between;
  }
}
  .modal-content {
    border-radius: 12px;
    border: none;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
  }

  .modal-header {
    background-color: #000c78;
    color: #fff;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
  }

  .form-label {
    font-weight: 600;
    color: #333;
  }

  .form-control {
    border-radius: 8px;
    padding: 0.75rem;
    font-size: 1rem;
  }

  .radio-option {
    display: flex;
    align-items: center;
    margin-bottom: 0.75rem;
    cursor: pointer;
  }

  .radio-option input[type="radio"] {
    margin-right: 0.6rem;
    transform: scale(1.2);
    accent-color: #000c78;
  }

  .radio-option label {
    margin: 0;
    font-weight: 500;
  }

  .btn-details {
    background-color: #000c78;
    color: white;
    border: none;
    padding: 0.65rem 1.25rem;
    border-radius: 8px;
    font-weight: 600;
    transition: background 0.3s;
  }

  .btn-details:hover {
    background-color: #000a60;
  }

  .hidden {
    display: none;
  }
</style>