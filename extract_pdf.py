import PyPDF2
import sys
import os
from pathlib import Path

def extract_pdf_info(pdf_path):
    """Extract text and metadata from PDF"""
    try:
        with open(pdf_path, 'rb') as file:
            reader = PyPDF2.PdfReader(file)

            print(f"\n{'='*60}")
            print(f"PDF: {os.path.basename(pdf_path)}")
            print(f"{'='*60}")
            print(f"Total Pages: {len(reader.pages)}")
            print(f"\n{'='*60}")
            print("TEXT CONTENT:")
            print(f"{'='*60}\n")

            for i, page in enumerate(reader.pages, 1):
                text = page.extract_text()
                if text.strip():
                    print(f"\n--- PAGE {i} ---\n")
                    print(text)
                    print("\n" + "-"*60)

    except Exception as e:
        print(f"Error processing {pdf_path}: {e}")

if __name__ == "__main__":
    pdf_dir = Path(r"G:\My Drive\Projects\Portfolio\Added Data")

    for pdf_file in pdf_dir.glob("*.pdf"):
        extract_pdf_info(pdf_file)
