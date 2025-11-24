import fitz  # PyMuPDF
from pathlib import Path
import os

def extract_images_from_pdf(pdf_path, output_folder):
    """Extract images from PDF"""
    pdf_name = Path(pdf_path).stem
    output_dir = Path(output_folder) / pdf_name
    output_dir.mkdir(parents=True, exist_ok=True)

    try:
        doc = fitz.open(pdf_path)
        image_count = 0

        for page_num in range(len(doc)):
            page = doc[page_num]

            # Get images on page
            image_list = page.get_images(full=True)

            for img_index, img in enumerate(image_list):
                xref = img[0]
                base_image = doc.extract_image(xref)
                image_bytes = base_image["image"]
                image_ext = base_image["ext"]

                # Save image
                image_filename = f"page{page_num+1:03d}_img{img_index+1:02d}.{image_ext}"
                image_path = output_dir / image_filename

                with open(image_path, "wb") as img_file:
                    img_file.write(image_bytes)

                image_count += 1
                print(f"Extracted: {image_filename}")

        print(f"\nTotal images extracted from {pdf_name}: {image_count}")
        doc.close()

    except Exception as e:
        print(f"Error processing {pdf_path}: {e}")

if __name__ == "__main__":
    pdf_dir = Path(r"G:\My Drive\Projects\Portfolio\Added Data")
    output_dir = Path(r"G:\My Drive\Projects\Portfolio\cloudways_site\assets\images")

    for pdf_file in pdf_dir.glob("*.pdf"):
        print(f"\n{'='*60}")
        print(f"Processing: {pdf_file.name}")
        print(f"{'='*60}")
        extract_images_from_pdf(pdf_file, output_dir)
