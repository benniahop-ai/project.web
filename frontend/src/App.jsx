import './App.css'
import { useEffect, useMemo, useState } from 'react'

function App() {
  const [books, setBooks] = useState([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState('')
  const [loanError, setLoanError] = useState('')
  const [loansLoading, setLoansLoading] = useState(false)
  const [query, setQuery] = useState('')
  const [activeTab, setActiveTab] = useState('books')
  const [selectedBookId, setSelectedBookId] = useState(null)
  const [loans, setLoans] = useState([])

  async function loadBooks() {
    try {
      setLoading(true)
      const response = await fetch('http://127.0.0.1:8000/api/books')
      if (!response.ok) {
        throw new Error('Gagal memuat data buku')
      }
      const data = await response.json()
      setBooks(data)
      setError('')
    } catch (err) {
      setError(err.message)
    } finally {
      setLoading(false)
    }
  }

  async function loadLoans() {
    try {
      setLoansLoading(true)
      const response = await fetch('http://127.0.0.1:8000/api/demo/loans')
      if (!response.ok) {
        throw new Error('Gagal memuat data peminjaman')
      }
      const data = await response.json()
      setLoans(data)
      setLoanError('')
    } catch (err) {
      setLoanError(err.message)
    } finally {
      setLoansLoading(false)
    }
  }

  useEffect(() => {
    loadBooks()
    loadLoans()
  }, [])

  const filteredBooks = useMemo(() => {
    const term = query.trim().toLowerCase()
    if (!term) {
      return books
    }

    return books.filter((book) => {
      const categoryName = book.category ? book.category.name : ''
      return (
        book.title.toLowerCase().includes(term) ||
        book.author.toLowerCase().includes(term) ||
        categoryName.toLowerCase().includes(term)
      )
    })
  }, [books, query])

  const selectedBook = useMemo(
    () => books.find((book) => book.id === selectedBookId) || null,
    [books, selectedBookId]
  )

  function handleSelectBook(book) {
    setSelectedBookId(book.id)
  }

  async function handleBorrow(book) {
    if (!book || book.stock <= 0) {
      return
    }

    try {
      const response = await fetch(
        `http://127.0.0.1:8000/api/demo/books/${book.id}/loans`,
        {
          method: 'POST',
        }
      )

      if (!response.ok) {
        const data = await response.json().catch(() => null)
        throw new Error(data?.message || 'Gagal meminjam buku')
      }

      await loadBooks()
      await loadLoans()
      setActiveTab('loans')
    } catch (err) {
      setError(err.message)
    }
  }

  async function handleReturn(loanId) {
    try {
      const response = await fetch(
        `http://127.0.0.1:8000/api/demo/loans/${loanId}/return`,
        {
          method: 'POST',
        }
      )

      if (!response.ok) {
        const data = await response.json().catch(() => null)
        throw new Error(data?.message || 'Gagal mengembalikan buku')
      }

      await loadBooks()
      await loadLoans()
    } catch (err) {
      setError(err.message)
    }
  }

  return (
    <div className="shell">
      <header className="app-header">
        <div className="app-brand">
          <span className="app-logo">📚</span>
          <div>
            <div className="app-title">Perpustakaan Mini</div>
            <div className="app-subtitle">Laravel API + React Frontend</div>
          </div>
        </div>
        <nav className="app-nav">
          <button
            type="button"
            className={
              activeTab === 'books'
                ? 'app-nav-item app-nav-item--active'
                : 'app-nav-item'
            }
            onClick={() => {
              setActiveTab('books')
            }}
          >
            Buku
          </button>
          <button
            type="button"
            className={
              activeTab === 'loans'
                ? 'app-nav-item app-nav-item--active'
                : 'app-nav-item'
            }
            onClick={() => setActiveTab('loans')}
          >
            Peminjaman
          </button>
        </nav>
      </header>

      <main className="page">
        {activeTab === 'books' && (
          <>
            <div className="page-header">
              <div>
                <h1>Daftar Buku</h1>
                <p>
                  Frontend terpisah (React) yang membaca data dari backend
                  Laravel.
                </p>
              </div>
              <div className="search-box">
                <input
                  type="text"
                  placeholder="Cari judul, penulis, atau kategori..."
                  value={query}
                  onChange={(e) => setQuery(e.target.value)}
                />
              </div>
            </div>

            {loading && <p>Memuat data buku...</p>}
            {error && <p className="error-text">{error}</p>}

            {!loading && !error && (
              <div className="layout-two-columns">
                <div className="table-wrapper">
                  <table className="book-table">
                    <thead>
                      <tr>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Stock</th>
                      </tr>
                    </thead>
                    <tbody>
                      {filteredBooks.map((book) => (
                        <tr
                          key={book.id}
                          className={
                            selectedBookId === book.id
                              ? 'book-row book-row--active'
                              : 'book-row'
                          }
                          onClick={() => handleSelectBook(book)}
                        >
                          <td>{book.title}</td>
                          <td>{book.author}</td>
                          <td>
                            <span className="badge">
                              {book.category ? book.category.name : '-'}
                            </span>
                          </td>
                          <td>{book.stock}</td>
                        </tr>
                      ))}
                    </tbody>
                  </table>

                  {filteredBooks.length === 0 && (
                    <p className="empty-text">
                      Tidak ada buku yang cocok dengan pencarian.
                    </p>
                  )}
                </div>

                <aside className="detail-panel">
                  {selectedBook ? (
                    <div className="detail-card">
                      <h2 className="detail-title">{selectedBook.title}</h2>
                      <p className="detail-meta">
                        <span>{selectedBook.author}</span>
                        {selectedBook.year && (
                          <>
                            <span>•</span>
                            <span>{selectedBook.year}</span>
                          </>
                        )}
                      </p>
                      <p className="detail-category">
                        Kategori:{' '}
                        <span>
                          {selectedBook.category
                            ? selectedBook.category.name
                            : '-'}
                        </span>
                      </p>
                      <p className="detail-stock">
                        Stock:{' '}
                        <span
                          className={
                            selectedBook.stock > 0
                              ? 'stock-badge stock-badge--available'
                              : 'stock-badge stock-badge--empty'
                          }
                        >
                          {selectedBook.stock > 0
                            ? `${selectedBook.stock} tersedia`
                            : 'Habis'}
                        </span>
                      </p>
                      <button
                        type="button"
                        className="primary-button"
                        disabled={selectedBook.stock <= 0}
                        onClick={() => handleBorrow(selectedBook)}
                      >
                        {selectedBook.stock > 0
                          ? 'Pinjam Buku Ini'
                          : 'Stock Habis'}
                      </button>
                    </div>
                  ) : (
                    <div className="detail-placeholder">
                      <p>Pilih salah satu buku untuk melihat detailnya.</p>
                    </div>
                  )}
                </aside>
              </div>
            )}
          </>
        )}

        {activeTab === 'loans' && (
          <div className="loans-page">
            <div className="page-header">
              <div>
                <h1>Peminjaman</h1>
                <p>
                  Data peminjaman disimpan di backend Laravel untuk user demo.
                </p>
              </div>
            </div>

            {loanError && <p className="error-text">{loanError}</p>}

            {loansLoading && <p>Memuat data peminjaman...</p>}

            {!loansLoading && loans.length === 0 ? (
              <p className="empty-text">
                Belum ada peminjaman. Pilih buku di tab Buku lalu klik
                &quot;Pinjam Buku Ini&quot;.
              </p>
            ) : (
              <div className="table-wrapper">
                <table className="loans-table">
                  <thead>
                    <tr>
                      <th>Buku</th>
                      <th>Tanggal Pinjam</th>
                      <th>Jatuh Tempo</th>
                      <th>Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    {loans.map((loan) => (
                      <tr key={loan.id}>
                        <td>{loan.book_title}</td>
                        <td>{loan.borrow_date}</td>
                        <td>{loan.return_deadline}</td>
                        <td>
                          <span
                            className={
                              loan.status === 'BORROWED'
                                ? 'status-badge status-badge--borrowed'
                                : 'status-badge status-badge--returned'
                            }
                          >
                            {loan.status}
                          </span>
                        </td>
                        <td className="loans-actions">
                          {loan.status === 'BORROWED' && (
                            <button
                              type="button"
                              className="secondary-button"
                              onClick={() => handleReturn(loan.id)}
                            >
                              Kembalikan
                            </button>
                          )}
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            )}
          </div>
        )}
      </main>
    </div>
  )
}

export default App
